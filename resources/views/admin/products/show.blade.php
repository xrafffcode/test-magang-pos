@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <a href="{{ route('app.products.edit', $product->id) }}" class="btn btn-info btn-sm mb-3">Edit</a>

            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>: {{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th>Deksripsi</th>
                            <td>: {{ $product->product_description }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Harga Beli</th>
                            <td>: {{ $product->formatted_capital }}</td>
                        </tr>
                        <tr>
                            <th>Harga Jual</th>
                            <td>: {{ $product->formatted_price }}</td>
                        </tr>
                    </table>
                </div>

            </div>
            <a href="{{ route('app.products.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>
@endsection
