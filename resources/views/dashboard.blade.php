@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto p-4">

    <!-- Header -->
    <div class="mt-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            📊 Dashboard
        </h1>

        <p class="text-gray-500 mt-1">
            Today's business summary
        </p>
    </div>

    <!-- Profit Card -->
    <div class="bg-green-600 text-white rounded-3xl p-6 shadow-lg mb-5">

        <p class="text-sm opacity-90">
            Profit Today
        </p>

        <h2 class="text-4xl font-bold mt-2">
            ${{ $profit }}
        </h2>

    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 gap-4">

        <div class="bg-white rounded-3xl p-5 shadow-sm">
            <p class="text-gray-500 text-sm">Sales</p>
            <h3 class="text-2xl font-bold mt-2">${{ $totalSales }}</h3>
@endsection