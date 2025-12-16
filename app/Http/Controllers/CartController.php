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

        $captainName = session()->get('captain_name', 'Guest');
        $token = session()->get('store_access_token');
        
        // Create Order
        $total = 0;
        foreach($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $order = Order::create([
            'captain_name' => $captainName,
            'token' => $token,
            'status' => 'pending',
            'total' => $total
        ]);

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

        // Invalidate token after checkout
        if($token) {
            StoreToken::where('token', $token)->update(['is_active' => false]);
        }

        // Clear cart and session
        session()->forget('cart');
        session()->forget('captain_name');
        session()->forget('store_access_token');

        return view('cart.success', compact('order'));
    }
}
