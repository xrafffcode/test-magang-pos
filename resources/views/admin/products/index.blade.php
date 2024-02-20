@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-body table-responsive">

            @if (check_authorized('006P'))
                <a href="{{ route('app.products.create') }}" class="btn btn-success btn-sm mb-3">Tambah</a>
            @endif


            @if (check_authorized('006P'))
                <table class="table table-bordered" id="tableProducts">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Deskrpsi</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Keuntungan</th>
                            <th>Persentase Keuntungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            @endif

        </div>
    </div>
@endsection

@if (check_authorized('006P'))
    @push('script')
        <script>
            CORE.dataTableServer("tableProducts", "/app/products/get");
        </script>
    @endpush
@endif
