@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('app.sales.store') }}" method="POST" with-submit-crud id="formSales">
                @csrf

                @include('admin.sales.form')

                <button class="btn btn-success btn-sm mt-3" id="submitSales">Tambah Penjualan</button>

            </form>

        </div>
    </div>
@endsection
