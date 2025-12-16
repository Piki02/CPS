<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // Ensure user is authorized to view this order
        // For now, allowing Branch Store and Admin, or the user who owns the order
        // You might want to add stricter policies later
        
        $order->load('items.product');
        return view('orders.show', compact('order'));
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
        return $pdf->stream('quotation-'.$order->id.'.pdf');
    }
}
