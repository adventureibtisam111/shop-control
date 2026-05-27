@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto p-4">

    <!-- Header -->
    <div class="mb-6 mt-4">
        <h1 class="text-3xl font-bold">
            ➕ Record Sale
        </h1>

        <p class="text-gray-500 mt-1">
            Fast business entry
        </p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 p-4 rounded-2xl mb-5 shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 p-4 rounded-2xl mb-5">
            <ul class="space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/sales" method="POST" class="bg-white rounded-3xl shadow-sm p-5 space-y-5">

        @csrf

        <!-- Item Name -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                📦 Item Name
            </label>
            <input 
                type="text" 
                name="item_name" 
                placeholder="Enter item name"
                value="{{ old('item_name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <!-- Selling Price -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                💵 Selling Price
            </label>
            <input 
                type="number" 
                name="selling_price" 
                placeholder="0.00"
                step="0.01"
                value="{{ old('selling_price') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <!-- Cost Price -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                💰 Cost Price
            </label>
            <input 
                type="number" 
                name="cost_price" 
                placeholder="0.00"
                step="0.01"
                value="{{ old('cost_price') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <!-- Quantity -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                📊 Quantity
            </label>
            <input 
                type="number" 
                name="quantity" 
                placeholder="1"
                min="1"
                value="{{ old('quantity') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <!-- Payment Method -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                💳 Payment Method
            </label>
            <select 
                name="payment_method" 
                id="payment_method"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
                <option value="">Select Payment Method</option>
                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                <option value="credit" {{ old('payment_method') == 'credit' ? 'selected' : '' }}>📋 Credit</option>
            </select>
        </div>

        <!-- Customer Name (only for credit) -->
        <div id="customer_name_div" style="display: none;">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                👤 Customer Name
            </label>
            <input 
                type="text" 
                name="customer_name" 
                placeholder="Enter customer name"
                value="{{ old('customer_name') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Remaining Balance (only for credit) -->
        <div id="remaining_balance_div" style="display: none;">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                💵 Remaining Balance
            </label>
            <input 
                type="number" 
                name="remaining_balance" 
                placeholder="0.00"
                step="0.01"
                value="{{ old('remaining_balance') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Submit Button -->
        <button 
            type="submit" 
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-xl transition duration-200"
        >
            ✅ Record Sale
        </button>

    </form>

</div>

<!-- Script to show/hide credit fields -->
<script>
    const paymentMethod = document.getElementById('payment_method');
    const customerNameDiv = document.getElementById('customer_name_div');
    const remainingBalanceDiv = document.getElementById('remaining_balance_div');

    paymentMethod.addEventListener('change', function() {
        if (this.value === 'credit') {
            customerNameDiv.style.display = 'block';
            remainingBalanceDiv.style.display = 'block';
        } else {
            customerNameDiv.style.display = 'none';
            remainingBalanceDiv.style.display = 'none';
        }
    });

    // Show credit fields if already selected (for page reload)
    if (paymentMethod.value === 'credit') {
        customerNameDiv.style.display = 'block';
        remainingBalanceDiv.style.display = 'block';
    }
</script>

@endsection
