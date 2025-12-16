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
            $ordersCount = \App\Models\Order::count();
            $usersCount = \App\Models\User::count();

            // Reporting Data
            $totalRevenue = \App\Models\Order::sum('total');
            
            // Monthly Sales (Last 6 months)
            $monthlySales = \App\Models\Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();

            // Top 5 Products
            $topProducts = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'))
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_qty')
                ->take(5)
                ->get();

            return view('dashboard', compact('productsCount', 'ordersCount', 'usersCount', 'totalRevenue', 'monthlySales', 'topProducts'));
        } 
        elseif ($user->hasRole('Branch Store')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            
            // Reporting Data for Branch
            $totalRevenue = $orders->sum('total');
            $ordersCount = $orders->count();
            
            // Monthly Sales (Last 6 months)
            $monthlySales = \App\Models\Order::where('user_id', $user->id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();

            return view('dashboard', compact('orders', 'totalRevenue', 'ordersCount', 'monthlySales'));
        } 
        elseif ($user->hasRole('Supplier')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            return view('dashboard', compact('orders'));
        }

        return view('dashboard');
    }
}
