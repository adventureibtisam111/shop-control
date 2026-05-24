@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto p-4">

    <div class="mt-6 mb-6">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-yellow-600 to-orange-600 bg-clip-text text-transparent">
            💳 Credit Customers
        </h1>

        <p class="text-gray-500 mt-2">
            Unpaid and partial balances
        </p>
    </div>

    <!-- Total Unpaid Alert -->
    @if($totalUnpaid > 0)
        <div class="bg-gradient-to-r from-orange-100 to-red-100 border-l-4 border-orange-500 rounded-2xl p-5 mb-6 shadow-lg">
            <p class="text-gray-600 text-sm font-semibold">Total Unpaid Amount</p>
            <h2 class="text-4xl font-bold mt-2 text-orange-600">${{ number_format($totalUnpaid, 2) }}</h2>
        </div>
    @endif

    <div class="space-y-4 mb-6">

        @forelse($credits as $credit)

            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-5 border-l-4 border-yellow-500">

                <div class="flex justify-between items-start gap-3">

                    <div class="flex-1">
                        <!-- Item Name -->
                        <h2 class="text-lg font-bold text-gray-800">
                            {{ $credit->item_name }}
                        </h2>

                        <!-- Customer Name -->
                        @if($credit->customer_name)
                            <p class="text-sm text-gray-600 mt-1">
                                👤 {{ $credit->customer_name }}
                            </p>
                        @endif

                        <!-- Details -->
                        <div class="grid grid-cols-2 gap-3 mt-3 text-sm">
                            <div>
                                <span class="text-gray-500">Qty:</span>
                                <p class="font-semibold text-gray-800">{{ $credit->quantity }} units</p>
                            </div>
                            <div>
                                <span class="text-gray-500">Price Each:</span>
                                <p class="font-semibold text-gray-800">${{ number_format($credit->selling_price, 2) }}</p>
                            </div>
                        </div>

                    </div>

                    <!-- Status Badge -->
                    <div class="text-right">
                        @if($credit->status === 'unpaid')
                            <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">
                                UNPAID
                            </span>
                        @elseif($credit->status === 'partial')
                            <span class="inline-block bg-yellow-100 text-yellow-700 text-xs font-bold px-3 py-1 rounded-full">
                                PARTIAL
                            </span>
                        @endif
                    </div>

                </div>

                <!-- Amount Section -->
                <div class="border-t border-gray-200 mt-4 pt-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs text-gray-500 font-semibold">Amount Owed</p>
                            <p class="text-2xl font-bold text-red-600 mt-1">
                                ${{ number_format($credit->amount_owed, 2) }}
                            </p>
                        </div>

                        @if($credit->remaining_balance && $credit->remaining_balance > 0)
                            <div class="bg-green-50 rounded-lg p-3">
                                <p class="text-xs text-gray-500 font-semibold">Already Paid</p>
                                <p class="text-2xl font-bold text-green-600 mt-1">
                                    ${{ number_format($credit->remaining_balance, 2) }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Date Info -->
                <div class="text-xs text-gray-500 mt-3 flex justify-between">
                    <span>📅 {{ $credit->created_at->format('M d, Y') }}</span>
                    @if($credit->last_payment_at)
                        <span>💰 Last payment: {{ $credit->last_payment_at->format('M d, Y') }}</span>
                    @endif
                </div>

            </div>

        @empty

            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-8 text-center shadow-lg">
                <p class="text-5xl mb-3">✅</p>
                <h3 class="text-xl font-bold text-green-700">No Outstanding Credits</h3>
                <p class="text-gray-600 mt-2">All customers have paid their balances!</p>
            </div>

        @endforelse

    </div>

</div>

@endsection
