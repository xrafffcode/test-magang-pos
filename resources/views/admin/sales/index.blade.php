@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body table-responsive">

            @if (check_authorized('007S'))
                <a href="{{ route('app.sales.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>
            @endif


            @if (check_authorized('007S'))
                <table class="table table-bordered" id="tableSales">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomer Order</th>
                            <th>Tanggal Order</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endif

        </div>
    </div>
@endsection

@if (check_authorized('007S'))
    @push('script')
        <script>
            CORE.dataTableServer("tableSales", "/app/sales/get");
        </script>
    @endpush
@endif
