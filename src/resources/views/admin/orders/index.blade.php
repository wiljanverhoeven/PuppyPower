<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="w-full mb-6 text-center">
            <h1 class="text-2xl font-bold text-[#606C38]">Alle Orders</h1>
        </div>

        <div class="bg-[#606C38] rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#283618] text-[#FEFAE0]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Order ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Gebruiker ID</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Totaal Prijs</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Aangemaakt op</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Items</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#DDA15E]/20">
                        @foreach ($orders as $order)
                            <tr class="transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0] font-medium">{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $order->user_id ?? 'Gast' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0] font-bold">€ {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-[#FEFAE0]">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                <td class="px-6 py-4 text-[#FEFAE0]">
                                    <ul class="space-y-1">
                                        @foreach ($order->orderItems as $item)
                                            <li class="text-sm">
                                                Product ID: {{ $item->product_id }} - Aantal: {{ $item->amount }} - Prijs p.st: €{{ number_format($item->price, 2, ',', '.') }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
