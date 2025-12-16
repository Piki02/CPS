<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home');
    }

    public function about()
    {
        return view('public.about');
    }

    public function services()
    {
        return view('public.services');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $query = \App\Models\Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12);
        $categories = \App\Models\Category::all();
        
        return view('public.store', compact('products', 'categories'));
    }
}
