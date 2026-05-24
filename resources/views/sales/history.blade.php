@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-4">

    <!-- Header -->
    <div class="mt-6 mb-6">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
            📋 Sales History
        </h1>

        <p class="text-gray-500 mt-2">
            Complete sales record
        </p>
    </div>

    <!-- Total Sales Count -->
    <div class="bg-white rounded-2xl p-4 mb-6 shadow-lg">
        <p class="text-gray-600 text-sm">Total Transactions</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $sales->total() }}</p>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        @if($sales->count() > 0)

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-bold">Item</th>
                            <th class="px-4 py-3 text-left text-sm font-bold">Qty</th>
                            <th class="px-4 py-3 text-left text-sm font-bold">Price</th>
                            <th class="px-4 py-3 text-left text-sm font-bold">Total</th>
                            <th class="px-4 py-3 text-left text-sm font-bold">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-bold">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($sales as $sale)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $sale->item_name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $sale->quantity }}</td>
                                <td class="px-4 py-3 text-gray-600">${{ number_format($sale->selling_price, 2) }}</td>
                                <td class="px-4 py-3 font-bold text-green-600">${{ number_format($sale->selling_price * $sale->quantity, 2) }}</td>
                                <td class="px-4 py-3">
                                    @if($sale->payment_method === 'cash')
                                        <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                                            💵 Cash
                                        </span>
                                    @else
                                        <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">
                                            💳 Credit
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $sale->created_at->format('M d, Y') }}</td>
                            </tr>

                            <!-- Expandable Row for Additional Details -->
                            @if($sale->customer_name || $sale->status)
                                <tr class="bg-gray-50 text-sm">
                                    <td colspan="6" class="px-4 py-3">
                                        <div class="flex gap-6">
                                            @if($sale->customer_name)
                                                <span class="text-gray-600">👤 Customer: <strong>{{ $sale->customer_name }}</strong></span>
                                            @endif
                                            @if($sale->status)
                                                <span class="text-gray-600">Status: <strong>{{ ucfirst($sale->status) }}</strong></span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($sales->hasPages())
                <div class="px-4 py-4 border-t border-gray-200 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Showing {{ $sales->firstItem() }} to {{ $sales->lastItem() }} of {{ $sales->total() }}
                    </div>

                    <div class="space-x-2">
                        @if($sales->onFirstPage())
                            <span class="px-3 py-1 text-gray-400 text-sm">← Previous</span>
                        @else
                            <a href="{{ $sales->previousPageUrl() }}" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                                ← Previous
                            </a>
                        @endif

                        @if($sales->hasMorePages())
                            <a href="{{ $sales->nextPageUrl() }}" class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                                Next →
                            </a>
                        @else
                            <span class="px-3 py-1 text-gray-400 text-sm">Next →</span>
                        @endif
                    </div>
                </div>
            @endif

        @else

            <div class="p-8 text-center">
                <p class="text-5xl mb-3">📭</p>
                <h3 class="text-xl font-bold text-gray-800">No sales recorded yet</h3>
                <p class="text-gray-600 mt-2">Start by recording your first sale!</p>
                <a href="/sales/create" class="inline-block mt-4 bg-blue-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-blue-700">
                    ➕ Record Sale
                </a>
            </div>

        @endif

    </div>

</div>

@endsection
