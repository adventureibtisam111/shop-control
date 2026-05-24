@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto p-4">

    <div class="mt-4 mb-6">
        <h1 class="text-3xl font-bold">
            💳 Credit Customers
        </h1>

        <p class="text-gray-500 mt-1">
            Unpaid and partial balances
        </p>
    </div>

    <div class="space-y-4">

        @forelse($credits as $credit)

            <div class="bg-white rounded-3xl shadow-sm p-5">

                <div class="flex justify-between items-start">

                    <div>
                        <h2 cl