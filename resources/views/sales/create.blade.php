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

@endsection