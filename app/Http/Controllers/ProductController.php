<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // LIST ALL PRODUCTS
    public function index()
    {
        $products = Product::where('is_active', true)->paginate(12);
        $categories = Product::distinct('category')->pluck('category');

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    // SHOW PRODUCT FORM
    public function create()
    {
        return view('products.create');
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'selling_price' => 'required|numeric|min:0.01',
            'cost_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:100',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'sku' => 'nullable|unique:products',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect('/products')
            ->with('success', 'Product added successfully! ✅');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'selling_price' => 'required|numeric|min:0.01',
            'cost_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:100',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect('/products')
            ->with('success', 'Product updated successfully! ✅');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/products')
            ->with('success', 'Product deleted successfully! ✅');
    }

    // FILTER BY CATEGORY
    public function filterByCategory($category)
    {
        $products = Product::where('category', $category)
            ->where('is_active', true)
            ->paginate(12);

        $categories = Product::distinct('category')->pluck('category');

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }
}