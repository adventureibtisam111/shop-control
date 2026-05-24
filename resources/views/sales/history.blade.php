<h2>📋 Sales History</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Item</th>
        <th>Price</th>
        <th>Cost</th>
        <th>Qty</th>
        <th>Payment</th>
        <th>Customer</th>
        <th>Date</th>
    </tr>

    @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->item_name }}</td>

            <td>{{ $sale->selling_price }}</td>

            <td>{{ $sale->cost_price }}</td>

            <td>{{ $sale->quantity }}</td>

            <td>{{ $sale->payment_method }}</td>

            <td>{{ $sale->customer_name ?? '-' }}</td>

            <td>{{ $sale->created_at->format('d M Y') }}</td>
        </tr>
    @endforeach
</table>