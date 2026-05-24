<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;

class SaleController extends Controller
{
    // SHOW FORM
    public function create()
    {
        return view('sales.create');
    }

    // STORE SALE
    public function store(Request $request)
    {
        $data = $request->validate([
            'item_name' => 'required',
            'selling_price' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required',
            'customer_name' => 'nullable',
            'remaining_balance' => 'nullable|numeric',
        ]);

        // CREDIT LOGIC
        if ($data['payment_method'] === 'credit') {

            $data['amount_owed'] = $data['selling_price'] * $data['quantity'];

            $data['status'] = ($data['remaining_balance'] > 0)
                ? 'partial'
                : 'unpaid';

            $data['last_payment_at'] = now();
        }

        Sale::create($data);

        return redirect()
            ->back()
            ->with('success', 'Sale recorded successfully!');
    }

    // DASHBOARD
    public function dashboard()
    {
        $today = Carbon::today();

        $sales = Sale::whereDate('created_at', $today)->get();

        $totalSales = $sales->sum(fn($sale) => $sale->selling_price * $sale->quantity);

        $totalCost = $sales->sum(fn($sale) => $sale->cost_price * $sale->quantity);

        $profit = $totalSales - $totalCost;

        $totalTransactions = $sales->count();

        $totalItemsSold = $sales->sum('quantity');

        $totalCashSales = $sales
            ->where('payment_method', 'cash')
            ->sum(fn($sale) => $sale->selling_price * $sale->quantity);

        $totalCreditSales = $sales
            ->where('payment_method', 'credit')
            ->sum(fn($sale) => $sale->selling_price * $sale->quantity);

        return view('dashboard', [
            'totalSales' => $totalSales,
            'totalCost' => $totalCost,
            'profit' => $profit,
            'totalTransactions' => $totalTransactions,
            'totalItemsSold' => $totalItemsSold,
            'totalCashSales' => $totalCashSales,
            'totalCreditSales' => $totalCreditSales,
        ]);
    }

    // CREDIT TRACKING
    public function credits()
    {
        $credits = Sale::where('payment_method', 'credit')
            ->whereIn('status', ['unpaid', 'partial'])
            ->latest()
            ->get();

        return view('credits.index', [
            'credits' => $credits
        ]);
    }
public function history()
{
    $sales = Sale::latest()->get();

    return view('sales.history', [
        'sales' => $sales
    ]);
}
}