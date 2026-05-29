@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-4xl font-bold text-gray-900">📋 Sales History</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($sales->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Item</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Quantity</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Price</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Total</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Payment</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $sale->item_name }}</div>
                                    @if($sale->customer_name)
                                        <div class="text-sm text-gray-600">{{ $sale->customer_name }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $sale->quantity }}</td>
                                <td class="px-6 py-4 text-gray-600">${{ number_format($sale->selling_price, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-blue-600">${{ number_format($sale->selling_price * $sale->quantity, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $sale->payment_method == 'cash' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($sale->payment_method) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold
                                        @if($sale->status == 'completed') bg-green-100 text-green-800
                                        @elseif($sale->status == 'paid') bg-blue-100 text-blue-800
                                        @elseif($sale->status == 'partial') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($sale->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $sale->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $sales->links() }}</div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-md">
                <p class="text-2xl text-gray-500">No sales history yet 📋</p>
            </div>
        @endif
    </div>
</div>

@endsection