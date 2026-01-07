<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\OrderItem;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Admin') || $user->hasRole('Supplier')) {
            $orders = Order::with('user')->latest()->get();
        } else {
            $orders = Order::where('user_id', $user->id)->latest()->get();
        }

        $ordersByStatus = $orders->groupBy('status');

        return view('orders.index', compact('ordersByStatus'));
    }

    public function show(Order $order)
    {
        // Ensure user is authorized to view this order
        // For now, allowing Branch Store and Admin, or the user who owns the order
        // You might want to add stricter policies later

        $order->load('items.product');
        $products = Product::all(); // Load products for the add/edit functionality
        return view('orders.show', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            'tax' => 'nullable|numeric|min:0',
            'shipping_cost' => 'nullable|numeric|min:0',
        ]);

        $discountPercentage = $request->discount_percentage ?? 0;
        $discountAmount = ($order->total * $discountPercentage) / 100;

        $order->update([
            'status' => $request->status,
            'discount_percentage' => $discountPercentage,
            'discount' => $discountAmount,
            'tax' => $request->tax ?? 0,
            'shipping_cost' => $request->shipping_cost ?? 0,
        ]);

        return redirect()->route('orders.show', $order)->with('success', 'Order updated successfully.');
    }

    public function generateQuotation(Order $order)
    {
        $order->load('items.product.category');
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('orders.quotation', compact('order'));
        return $pdf->stream('quotation-' . $order->id . '.pdf');
    }

    public function destroy(Order $order)
    {
        // Optional: Add authorization check here
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // New methods for Order Item Management

    public function addProduct(Request $request, Order $order)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'unit_price' => $product->price,
            'subtotal' => $product->price * $request->quantity,
        ]);

        $this->recalculateTotals($order);

        return redirect()->route('orders.show', $order)->with('success', 'Product added to order successfully.');
    }

    public function updateItem(Request $request, Order $order, OrderItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Ensure item belongs to order
        if ($item->order_id !== $order->id) {
            abort(403);
        }

        $item->update([
            'quantity' => $request->quantity,
            'subtotal' => $item->unit_price * $request->quantity,
        ]);

        $this->recalculateTotals($order);

        return redirect()->route('orders.show', $order)->with('success', 'Order item updated successfully.');
    }

    public function removeItem(Order $order, OrderItem $item)
    {
        // Ensure item belongs to order
        if ($item->order_id !== $order->id) {
            abort(403);
        }

        $item->delete();

        $this->recalculateTotals($order);

        return redirect()->route('orders.show', $order)->with('success', 'Product removed from order successfully.');
    }

    protected function recalculateTotals(Order $order)
    {
        $subtotal = $order->items()->sum('subtotal');

        // Recalculate discount based on percentage if it exists
        $discountAmount = ($subtotal * $order->discount_percentage) / 100;

        $order->update([
            'discount' => $discountAmount,
            'total' => $subtotal // Order total in DB seems to be subtotal based on previous context, or final total? 
            // Looking at update method: total is used to calc discount. 
            // In blade: Grand Total = total - discount + tax + shipping. 
            // So 'total' field in DB likely represents the Subtotal of items.
            // Let's verify with the update method logic: 
            // $discountAmount = ($order->total * $discountPercentage) / 100;
            // Yes, order->total acts as subtotal.
        ]);
    }

    public function export(Order $order)
    {
        return Excel::download(new OrderExport($order), 'order_' . $order->id . '.xlsx');
    }
}
