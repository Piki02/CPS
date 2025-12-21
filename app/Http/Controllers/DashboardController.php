<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Initialize default values for all possible variables
        $productsCount = 0;
        $ordersCount = 0;
        $usersCount = 0;
        $totalRevenue = 0;
        $vesselsCount = 0;
        $exchangeRate = \App\Models\Setting::where('key', 'exchange_rate')->value('value') ?? 7.8;
        $monthlySales = collect();
        $topProducts = collect();
        $bestSellingProduct = null;
        $orders = collect();

        if ($user->hasRole('Admin')) {
            $productsCount = \App\Models\Product::count();
            $ordersCount = \App\Models\Order::count();
            $usersCount = \App\Models\User::count();
            $totalRevenue = \App\Models\Order::sum('total');

            $monthlySales = \App\Models\Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();

            $topProducts = \App\Models\OrderItem::select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'))
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_qty')
                ->take(5)
                ->get();

            $bestSellingProduct = $topProducts->first();
            $vesselsCount = \App\Models\Order::whereNotNull('vessel_name')->distinct('vessel_name')->count('vessel_name');
        } elseif ($user->hasRole('Branch Store')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            $ordersCount = $orders->count();
            $totalRevenue = $orders->sum('total');
            $vesselsCount = \App\Models\Order::where('user_id', $user->id)->whereNotNull('vessel_name')->distinct('vessel_name')->count('vessel_name');

            // Branch specific products and sales
            $productsCount = \App\Models\Product::count(); // Total products are still global

            $topProducts = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
                ->select('product_id', \Illuminate\Support\Facades\DB::raw('SUM(quantity) as total_qty'))
                ->with('product')
                ->groupBy('product_id')
                ->orderByDesc('total_qty')
                ->take(5)
                ->get();

            $bestSellingProduct = $topProducts->first();

            $monthlySales = \App\Models\Order::where('user_id', $user->id)
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as total')
                ->groupBy('month')
                ->orderBy('month', 'desc')
                ->take(6)
                ->get()
                ->reverse();
        } elseif ($user->hasRole('Supplier')) {
            $orders = \App\Models\Order::where('user_id', $user->id)->latest()->get();
            $ordersCount = $orders->count();
        }

        return view('dashboard', compact(
            'productsCount',
            'ordersCount',
            'usersCount',
            'totalRevenue',
            'monthlySales',
            'topProducts',
            'vesselsCount',
            'bestSellingProduct',
            'exchangeRate',
            'orders'
        ));
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
