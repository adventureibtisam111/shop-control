@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">📊 Dashboard</h1>
            <p class="text-gray-600">Today's sales overview</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Sales -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Sales</p>
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($totalSales, 2) }}</p>
                    </div>
                    <div class="text-4xl">💵</div>
                </div>
            </div>

            <!-- Total Cost -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Cost</p>
                        <p class="text-3xl font-bold text-gray-900">${{ number_format($totalCost, 2) }}</p>
                    </div>
                    <div class="text-4xl">💰</div>
                </div>
            </div>

            <!-- Profit -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Profit</p>
                        <p class="text-3xl font-bold text-green-600">${{ number_format($profit, 2) }}</p>
                    </div>
                    <div class="text-4xl">📈</div>
                </div>
            </div>

            <!-- Transactions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Transactions</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalTransactions }}</p>
                    </div>
                    <div class="text-4xl">📊</div>
                </div>
            </div>
        </div>

        <!-- Sales Breakdown -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Cash vs Credit -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6">💳 Payment Methods</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Cash Sales</span>
                            <span class="font-bold">${{ number_format($totalCashSales, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalSales > 0 ? ($totalCashSales / $totalSales) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Credit Sales</span>
                            <span class="font-bold">${{ number_format($totalCreditSales, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $totalSales > 0 ? ($totalCreditSales / $totalSales) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold mb-6">🎯 Quick Actions</h2>
                <div class="space-y-3">
                    <a href="/sales/create" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                        ➕ Record New Sale
                    </a>
                    <a href="/products" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                        📦 Manage Products
                    </a>
                    <a href="/credits" class="block w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                        💳 Track Credits
                    </a>
                    <a href="/sales/history" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                        📋 Sales History
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-gray-600 text-sm mb-2">📦 Items Sold</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalItemsSold }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-gray-600 text-sm mb-2">💳 Total Credits Owed</p>
                <p class="text-3xl font-bold text-red-600">${{ number_format($unpaidCredits, 2) }}</p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <p class="text-gray-600 text-sm mb-2">📊 Profit Margin</p>
                <p class="text-3xl font-bold text-green-600">{{ $totalCost > 0 ? number_format(($profit / $totalCost) * 100, 1) : 0 }}%</p>
            </div>
        </div>
    </div>
</div>

@endsection