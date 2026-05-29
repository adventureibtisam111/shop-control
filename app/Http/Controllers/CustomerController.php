<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // LIST ALL CUSTOMERS
    public function index()
    {
        $customers = Customer::paginate(15);
        return view('customers.index', ['customers' => $customers]);
    }

    // CREATE CUSTOMER FORM
    public function create()
    {
        return view('customers.create');
    }

    // STORE CUSTOMER
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:customers',
            'address' => 'nullable|string',
        ]);

        Customer::create($data);

        return redirect('/customers')
            ->with('success', 'Customer added successfully! ✅');
    }

    // SHOW CUSTOMER DETAILS
    public function show($id)
    {
        $customer = Customer::with('sales')->findOrFail($id);
        return view('customers.show', ['customer' => $customer]);
    }

    // EDIT CUSTOMER
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', ['customer' => $customer]);
    }

    // UPDATE CUSTOMER
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $customer->update($data);

        return redirect('/customers')
            ->with('success', 'Customer updated successfully! ✅');
    }

    // DELETE CUSTOMER
    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect('/customers')
            ->with('success', 'Customer deleted successfully! ✅');
    }
}
