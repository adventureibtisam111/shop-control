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
            'item_name' => 'required|string|max:255',
            'selling_price' => 'required|numeric|min:0.01',
            'cost_price' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,credit',
            'customer_name' => 'nullable|string|max:255',
            'remaining_balance' => 'nullable|numeric|min:0',
        ]);

        $totalAmount = $data['selling_price'] * $data['quantity'];

        // CREDIT LOGIC - Fixed
        if ($data['payment_method'] === 'credit') {
            $data['amount_owed'] = $totalAmount;
            
            $remainingBalance = $data['remaining_balance'] ?? 0;
            
            // Determine status based on remaining balance
            if ($remainingBalance >= $totalAmount) {
                $data['status'] = 'paid';
            } elseif ($remainingBalance > 0) {
                $data['status'] = 'partial';
            } else {
                $data['status'] = 'unpaid';
            }

            $data['last_payment_at'] = now();
        } else {
            // Cash sales
            $data['status'] = 'completed';
        }

        Sale::create($data);

        return redirect()
            ->back()
            ->with('success', 'Sale recorded successfully! ✅');
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

        $unpaidCredits = Sale::where('payment_method', 'credit')
            ->whereIn('status', ['unpaid', 'partial'])
            ->sum('amount_owed');

        return view('dashboard', [
            'totalSales' => $totalSales,
            'totalCost' => $totalCost,
            'profit' => $profit,
            'totalTransactions' => $totalTransactions,
            'totalItemsSold' => $totalItemsSold,
            'totalCashSales' => $totalCashSales,
            'totalCreditSales' => $totalCreditSales,
            'unpaidCredits' => $unpaidCredits,
        ]);
    }

    // CREDIT TRACKING
    public function credits()
    {
        $credits = Sale::where('payment_method', 'credit')
            ->whereIn('status', ['unpaid', 'partial'])
            ->latest()
            ->get();

        $totalUnpaid = $credits->sum('amount_owed');

        return view('credits.index', [
            'credits' => $credits,
            'totalUnpaid' => $totalUnpaid,
        ]);
    }

    public function history()
    {
        $sales = Sale::latest()->paginate(15);

        return view('sales.history', [
            'sales' => $sales
        ]);
    }
}
