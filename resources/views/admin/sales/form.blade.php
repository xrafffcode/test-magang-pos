<x-forms.input-grid col1="2" col2="6" label="Order Number" name="order_number" type="text" :value="$sales->order_number ?? ''"
    id="order_number" />

<x-forms.input-grid col1="2" col2="6" label="Order Date" name="order_date" type="date" :value="$sales->order_date ?? ''"
    id="order_date" />

<label for="product" class="col-md-2 col-form-label">Produk</label>
<div class="col-12">

    <div class="row">
        @foreach ($products as $product)
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        <p class="card-text">{{ $product->formatted_price }}</p>
                        <input type="hidden" class="product-price" value="{{ $product->product_price_sell }}">
                        <input type="number" class="form-control product-quantity" value="1" min="1">
                        <a href="#" class="btn btn-primary btn-select-product mt-2"
                            data-product-id="{{ $product->id }}">Tambah</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

<div class="col-12">
    <label for="product" class="col-md-2 col-form-label">Produk yang akan dibeli</label>
    <ul class="list-group" id="listProduct">

    </ul>
</div>


@push('script')
    <script src="{{ asset('assets/js/apps/user.js?v=' . random_string(6)) }}"></script>


    <script>
        $(document).ready(function() {
            $('.btn-select-product').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var productName = $(this).closest('.card-body').find('.card-title').text();
                var productPrice = $(this).closest('.card-body').find('.product-price').val();
                var quantity = $(this).closest('.card-body').find('.product-quantity').val();

                var productInfo = {
                    product_id: productId,
                    quantity: quantity,
                    price: productPrice
                };

                var input = '<input type="hidden" name="order_items[]" value=\'' + JSON.stringify(
                        productInfo) +
                    '\'>';

                $('#formSales').append(input);




                var listItem =
                    '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                    productName +
                    '<span class="badge bg-primary rounded-pill">' + quantity + '</span>' +
                    '<button class="btn btn-danger btn-remove-product" data-product-id="' + productId +
                    '">Kurangi</button>' +
                    '</li>';

                $('#listProduct').append(listItem);
            });


            $(document).on('click', '.btn-remove-product', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                $(this).closest('li').remove();
                $('#formSales').find('input[name="order_items[]"][value*="' + productId + '"]').remove();
            });
        });
    </script>
@endpush
