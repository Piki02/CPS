<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('Admin')) {
            $productsCount = \App\Models\Product::count();
            // $ordersCount = \App\Models\Order::count(); // Commented until orders table exists
            $ordersCount = 0;
            $usersCount = \App\Models\User::count();
            return view('dashboard', compact('productsCount', 'ordersCount', 'usersCount'));
        } 
        elseif ($user->hasRole('Branch Store')) {
            // $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            $orders = collect(); // Empty collection until orders table exists
            return view('dashboard', compact('orders'));
        } 
        elseif ($user->hasRole('Supplier')) {
            // $orders = \App\Models\Order::with('user')->latest()->get();
            $orders = collect(); // Empty collection until orders table exists
            return view('dashboard', compact('orders'));
        }

        return view('dashboard');
    }
}
