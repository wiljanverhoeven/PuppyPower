<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(15);
        return view('admin.producten.index', compact('products'));
    }

    public function create()
    {
        return view('admin.producten.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        Product::create($validated);
        return redirect()->route('admin.producten.index')->with('success', 'Product toegevoegd');
    }

    public function edit(Product $product)
    {
        return view('admin.producten.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $product->update($validated);
        return redirect()->route('admin.producten.index')->with('success', 'Product bijgewerkt');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.producten.index')->with('success', 'Product verwijderd');
    }
}
