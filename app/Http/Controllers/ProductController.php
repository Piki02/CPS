<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Product; // Added this line

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(15);
        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'unit' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // 1. Save in normal storage (storage/app/public/products)
            $path = $image->storeAs('products', $imageName, 'public');

            // 2. Copy to public/storage (using File facade for robustness)
            $publicStoragePath = public_path('storage/products');
            if (!\Illuminate\Support\Facades\File::exists($publicStoragePath)) {
                \Illuminate\Support\Facades\File::makeDirectory($publicStoragePath, 0755, true);
            }

            \Illuminate\Support\Facades\File::copy(storage_path('app/public/' . $path), $publicStoragePath . '/' . $imageName);

            // 3. Save relative path in DB
            $data['image_path'] = 'storage/products/' . $imageName;
        }

        \App\Models\Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Request $request, \App\Models\Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, \App\Models\Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'unit' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // 1. Save in normal storage (storage/app/public/products)
            $path = $image->storeAs('products', $imageName, 'public');

            // 2. Copy to public/storage
            $publicStoragePath = public_path('storage/products');
            if (!\Illuminate\Support\Facades\File::exists($publicStoragePath)) {
                \Illuminate\Support\Facades\File::makeDirectory($publicStoragePath, 0755, true);
            }

            \Illuminate\Support\Facades\File::copy(storage_path('app/public/' . $path), $publicStoragePath . '/' . $imageName);

            // 3. Save relative path in DB
            $data['image_path'] = 'storage/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('products.index', [
            'page' => $request->input('page'),
            'search' => $request->input('search'),
            'category' => $request->input('category'),
        ])->with('success', 'Product updated successfully.');
    }

    public function destroy(\App\Models\Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new ProductImport, $request->file('file'));
            return redirect()->back()->with('success', 'Products imported successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function export()
    {
        $products = \App\Models\Product::with('category')->get();

        $csvData = [];
        $csvData[] = ['No', 'Categories', 'Product', 'Unit', 'Price'];

        foreach ($products as $index => $product) {
            $csvData[] = [
                $index + 1,
                $product->category->name ?? 'Uncategorized',
                $product->name,
                $product->unit,
                number_format($product->price, 2, '.', '')
            ];
        }

        $filename = 'products_export_' . date('Y-m-d_His') . '.csv';

        $handle = fopen('php://output', 'w');
        ob_start();

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
        $csv = ob_get_clean();

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
