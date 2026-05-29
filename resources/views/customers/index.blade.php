@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">👥 Customers</h1>
                    <p class="text-gray-600 mt-1">Manage your customer list</p>
                </div>
                <a href="/customers/create" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                    ➕ Add Customer
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        @if($customers->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Phone</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Total Spent</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Amount Owed</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $customer->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $customer->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $customer->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-green-600">${{ number_format($customer->total_spent, 2) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-red-600">${{ number_format($customer->total_owed, 2) }}</span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="/customers/{{ $customer->id }}" class="text-blue-600 hover:text-blue-800 font-bold">👁️</a>
                                    <a href="/customers/{{ $customer->id }}/edit" class="text-yellow-600 hover:text-yellow-800 font-bold">✏️</a>
                                    <form action="/customers/{{ $customer->id }}" method="POST" class="inline" onsubmit="return confirm('Delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-bold">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $customers->links() }}</div>
        @else
            <div class="text-center py-12 bg-white rounded-xl shadow-md">
                <p class="text-2xl text-gray-500">No customers yet 🙁</p>
                <a href="/customers/create" class="text-blue-600 hover:underline mt-4 inline-block">Add your first customer</a>
            </div>
        @endif
    </div>
</div>

@endsection