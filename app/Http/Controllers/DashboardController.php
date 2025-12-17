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

            $bestSellingProduct = $topProducts->first();

            $vesselsCount = \App\Models\Order::whereNotNull('vessel_name')->distinct('vessel_name')->count('vessel_name');

            $exchangeRate = \App\Models\Setting::where('key', 'exchange_rate')->value('value') ?? 7.8;

            return view('dashboard', compact('productsCount', 'ordersCount', 'usersCount', 'totalRevenue', 'monthlySales', 'topProducts', 'vesselsCount', 'bestSellingProduct', 'exchangeRate'));
        } 
        elseif ($user->hasRole('Branch Store')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            
            // Reporting Data for Branch
            $totalRevenue = $orders->sum('total');
            $ordersCount = $orders->count();
            $vesselsCount = \App\Models\Order::where('user_id', $user->id)->whereNotNull('vessel_name')->distinct('vessel_name')->count('vessel_name');
            
            // Best Selling Product for Branch
            $bestSellingProduct = \App\Models\OrderItem::whereHas('order', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'))
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_qty')
                ->first();

            // Monthly Sales (Last 6 months)
            $monthlySales = \App\Models\Order::where('user_id', $user->id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();

            return view('dashboard', compact('orders', 'totalRevenue', 'ordersCount', 'monthlySales', 'vesselsCount', 'bestSellingProduct'));
        } 
        elseif ($user->hasRole('Supplier')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            return view('dashboard', compact('orders'));
        }

        return view('dashboard');
    }

    public function updateExchangeRate(Request $request)
    {
        $request->validate([
            'exchange_rate' => 'required|numeric|min:0',
        ]);

        \App\Models\Setting::updateOrCreate(
            ['key' => 'exchange_rate'],
            ['value' => $request->exchange_rate]
        );

        return redirect()->back()->with('success', 'Exchange rate updated successfully.');
    }
}
