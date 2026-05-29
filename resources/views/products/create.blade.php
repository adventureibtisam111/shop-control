@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-2">➕ Add New Product</h1>
        <p class="text-gray-600 mb-6">Add a new clothing item to your inventory</p>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/products" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Product Name -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Product Name</label>
                <input type="text" name="name" required value="{{ old('name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="4" value="{{ old('description') }}"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Selling Price</label>
                    <input type="number" name="selling_price" required step="0.01" value="{{ old('selling_price') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cost Price</label>
                    <input type="number" name="cost_price" required step="0.01" value="{{ old('cost_price') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Quantity in Stock</label>
                <input type="number" name="quantity" required value="{{ old('quantity') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Category</label>
                <input type="text" name="category" required value="{{ old('category') }}" placeholder="e.g., Men, Women, Kids"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Size & Color -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Size</label>
                    <input type="text" name="size" value="{{ old('size') }}" placeholder="e.g., S, M, L, XL"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Color</label>
                    <input type="text" name="color" value="{{ old('color') }}" placeholder="e.g., Red, Blue, Black"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- SKU -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">SKU (Optional)</label>
                <input type="text" name="sku" value="{{ old('sku') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Product Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox" name="is_active" value="1" checked
                       class="w-4 h-4 text-blue-600 rounded focus:ring-2 focus:ring-blue-500">
                <label class="ml-2 text-sm font-medium text-gray-700">Active Product</label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    ✅ Add Product
                </button>
                <a href="/products" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-6 rounded-lg transition text-center">
                    ❌ Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection