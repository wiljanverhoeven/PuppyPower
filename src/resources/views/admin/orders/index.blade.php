<x-app-layout>
    <h1>Alle Orders</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Gebruiker ID</th>
                <th>Totaal Prijs</th>
                <th>Aangemaakt op</th>
                <th>Items</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user_id ?? 'Gast' }}</td>
                    <td>€ {{ number_format($order->totaal_prijs, 2, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>
                                    Product ID: {{ $item->product_id }} - Aantal: {{ $item->amount }} - Prijs p.st: €{{ number_format($item->prijs, 2, ',', '.') }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    {{ $orders->links() }}
</x-app-layout>
