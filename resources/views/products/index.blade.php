@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">👕 Our Products</h1>
                    <p class="text-gray-600 mt-1">Browse our amazing collection of clothes</p>
                </div>
                <a href="/products/create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                    ➕ Add Product
                </a>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex overflow-x-auto gap-2 pb-2">
                <a href="/products" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-semibold">
                    All Products
                </a>
                @foreach($categories as $category)
                    <a href="/products/category/{{ $category }}" 
                       class="px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-gray-300">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden">
                        <!-- Product Image -->
                        <div class="relative h-64 bg-gray-200 overflow-hidden">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-4xl">
                                    👕
                                </div>
                            @endif
                            <!-- Stock Badge -->
                            <div class="absolute top-3 right-3">
                                @if($product->inStock())
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold">In Stock</span>
                                @else
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">Out of Stock</span>
                                @endif
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                            
                            <div class="flex gap-2 mb-3">
                                @if($product->color)
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Color: {{ $product->color }}</span>
                                @endif
                                @if($product->size)
                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">Size: {{ $product->size }}</span>
                                @endif
                            </div>

                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 50) }}</p>

                            <!-- Price -->
                            <div class="mb-4">
                                <span class="text-2xl font-bold text-blue-600">${{ number_format($product->selling_price, 2) }}</span>
                                <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($product->cost_price, 2) }}</span>
                            </div>

                            <!-- Stock Info -->
                            <p class="text-sm text-gray-600 mb-4">Stock: {{ $product->quantity }} units</p>

                            <!-- Actions -->
                            <div class="flex gap-2">
                                <form action="/cart/add" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition">
                                        🛒 Add to Cart
                                    </button>
                                </form>
                                <a href="/products/{{ $product->id }}/edit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition">
                                    ✏️
                                </a>
                                <form action="/products/{{ $product->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-2xl text-gray-500">No products found 😔</p>
                <a href="/products/create" class="text-blue-600 hover:underline mt-4 inline-block">Add your first product</a>
            </div>
        @endif
    </div>
</div>

@endsection