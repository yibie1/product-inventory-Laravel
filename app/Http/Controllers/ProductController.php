<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        // Save to database
        $product = Product::create($validated);

        // Prepare data for JSON file
        $data = [
            'name' => $product->name,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'datetime_submitted' => $product->created_at,
            'total_value' => $product->quantity * $product->price,
        ];

        // Read existing data from JSON
        $filePath = storage_path('app/products.json');
        $existingData = [];

        if (file_exists($filePath)) {
            $existingData = json_decode(file_get_contents($filePath), true);
        }

        // Append new data
        $existingData[] = $data;

        // Save back to JSON file
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

        return redirect()->route('products.index');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('products.index');
    }
}
