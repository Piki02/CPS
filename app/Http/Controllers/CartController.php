<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoreToken;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_path,
                "unit" => $product->unit
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed successfully!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('store')->with('error', 'Cart is empty!');
        }

        $captainName = session()->get('captain_name');
        if (!$captainName && \Illuminate\Support\Facades\Auth::check()) {
            $captainName = \Illuminate\Support\Facades\Auth::user()->name;
        }
        $captainName = $captainName ?? 'Guest';
        $token = session()->get('store_access_token');
        
        // Create Order
        $total = 0;
        foreach($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $order = new Order();
        $order->captain_name = $captainName;
        $order->token = $token;
        $order->status = 'pending';
        $order->total = $total;

        // Assign User ID
        if (\Illuminate\Support\Facades\Auth::check()) {
            $order->user_id = \Illuminate\Support\Facades\Auth::id();
        } elseif ($token) {
            $storeToken = StoreToken::where('token', $token)->first();
            if ($storeToken) {
                $order->user_id = $storeToken->created_by;
                $order->vessel_name = $storeToken->vessel_name;
            }
        }
        
        // Fallback or override if session has it (e.g. from token validation)
        if (session('vessel_name')) {
            $order->vessel_name = session('vessel_name');
        }

        $order->save();

        // Create Order Items
        foreach($cart as $id => $details) {
            $subtotal = $details['price'] * $details['quantity'];
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'unit_price' => $details['price'],
                'subtotal' => $subtotal
            ]);
        }

        // Deactivate token after checkout
        if($token) {
            StoreToken::where('token', $token)->update(['is_active' => false]);
        }

        // Clear cart and session
        session()->forget('cart');
        session()->forget('captain_name');
        session()->forget('store_access_token');

        // Send Email Notification
        try {
            \Illuminate\Support\Facades\Mail::to('Supply@caribbeanps.com.gt')->send(new \App\Mail\OrderCreated($order));
        } catch (\Exception $e) {
            // Log error but don't stop the process
            \Illuminate\Support\Facades\Log::error('Failed to send order email: ' . $e->getMessage());
        }

        return view('cart.success', compact('order'));
    }
}
