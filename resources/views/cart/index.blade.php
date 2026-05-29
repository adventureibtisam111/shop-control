@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold text-gray-900">🛒 Shopping Cart</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        @foreach($cartItems as $item)
                            <div class="border-b p-6 flex gap-4">
                                <!-- Product Image -->
                                <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-2xl">👕</div>
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">Category: {{ $item->product->category }}</p>
                                    
                                    @if($item->size || $item->color)
                                        <p class="text-sm text-gray-600">
                                            @if($item->size) Size: {{ $item->size }} @endif
                                            @if($item->color) Color: {{ $item->color }} @endif
                                        </p>
                                    @endif

                                    <p class="text-xl font-bold text-blue-600 mt-2">${{ number_format($item->price, 2) }}</p>
                                </div>

                                <!-- Quantity & Actions -->
                                <div class="flex flex-col items-end gap-4">
                                    <form action="/cart/{{ $item->id }}/quantity" method="POST" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->quantity }}"
                                               class="w-16 px-2 py-1 border border-gray-300 rounded">
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Update</button>
                                    </form>

                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Subtotal</p>
                                        <p class="text-2xl font-bold text-gray-900">${{ number_format($item->getTotalPrice(), 2) }}</p>
                                    </div>

                                    <form action="/cart/{{ $item->id }}" method="POST" onsubmit="return confirm('Remove from cart?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">🗑️ Remove</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white rounded-xl shadow-md p-6 h-fit">
                    <h2 class="text-2xl font-bold mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping:</span>
                            <span class="font-bold">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax:</span>
                            <span class="font-bold">${{ number_format($total * 0.1, 2) }}</span>
                        </div>
                    </div>

                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold">Total:</span>
                            <span class="text-2xl font-bold text-blue-600">${{ number_format($total * 1.1, 2) }}</span>
                        </div>
                    </div>

                    <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg mb-3 transition">
                        ✅ Proceed to Checkout
                    </button>

                    <a href="/products" class="w-full block text-center bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-4 rounded-lg transition">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-xl shadow-md">
                <p class="text-4xl mb-4">🛒</p>
                <p class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</p>
                <p class="text-gray-600 mb-6">Start shopping to add items to your cart</p>
                <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg inline-block transition">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>
</div>

@endsection