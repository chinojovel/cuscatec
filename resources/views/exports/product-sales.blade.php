<table>
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Total Products Sold</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->product_id }}</td>
                <td>{{ $sale->product_name }}</td>
                <td>{{ $sale->total_products_sold }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
