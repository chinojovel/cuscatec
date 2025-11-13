<table>
    <thead>
        <tr>
            <th>Warehouse</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Last Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->warehouse->name }}</td>
                <td>{{ $stock->product->name }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>{{ $stock->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
