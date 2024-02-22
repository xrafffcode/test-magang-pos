@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>Oder Number</th>
                            <td>: {{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Order</th>
                            <td>: {{ $order->order_date }}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>: {{ $order->formatted_total }}</td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($order->order_items as $item)
                                            <tr>
                                                <td>{{ $item->product->product_name }}</td>
                                                <td>{{ $item->product->formatted_price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->formatted_subtotal }}</td>
                                            </tr>
                                            @php
                                                $total += $item->total;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right">Total</td>
                                            <td>{{ number_format($total, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <a href="{{ route('app.sales.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>
@endsection
