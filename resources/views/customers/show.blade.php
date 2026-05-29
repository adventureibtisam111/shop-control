@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $customer->name }}</h1>
                <p class="text-gray-600">Customer Profile</p>
            </div>
            <a href="/customers" class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg">← Back</a>
        </div>

        <!-- Customer Info -->
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <p class="text-sm text-gray-600 mb-1">📱 Phone</p>
                <p class="text-lg font-bold">{{ $customer->phone ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">📧 Email</p>
                <p class="text-lg font-bold">{{ $customer->email ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">💰 Total Spent</p>
                <p class="text-lg font-bold text-green-600">${{ number_format($customer->total_spent, 2) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">💳 Amount Owed</p>
                <p class="text-lg font-bold text-red-600">${{ number_format($customer->total_owed, 2) }}</p>
            </div>
        </div>

        @if($customer->address)
            <div class="mb-8">
                <p class="text-sm text-gray-600 mb-2">📍 Address</p>
                <p class="text-gray-700">{{ $customer->address }}</p>
            </div>
        @endif

        <!-- Purchase History -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Purchase History</h2>
            @if($customer->sales->count() > 0)
                <div class="bg-gray-50 rounded-lg overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-bold">Item</th>
                                <th class="px-4 py-2 text-left text-sm font-bold">Amount</th>
                                <th class="px-4 py-2 text-left text-sm font-bold">Type</th>
                                <th class="px-4 py-2 text-left text-sm font-bold">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->sales as $sale)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $sale->item_name }}</td>
                                    <td class="px-4 py-2 font-bold">${{ number_format($sale->selling_price * $sale->quantity, 2) }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $sale->payment_method == 'cash' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($sale->payment_method) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm">{{ $sale->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600">No purchases yet</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex gap-4">
            <a href="/customers/{{ $customer->id }}/edit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                ✏️ Edit
            </a>
            <form action="/customers/{{ $customer->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this customer?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    🗑️ Delete
                </button>
            </form>
        </div>
    </div>
</div>

@endsection