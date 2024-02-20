<x-forms.input-grid col1="2" col2="6" label="Nama Produk" name="product_name"
    value="{{ $product->product_name ?? '' }}" placeholder="Masukan nama produk..."></x-forms.input-grid>

<x-forms.input-grid col1="2" col2="6" label="Deskripsi" name="product_description"
    value="{{ $product->product_description ?? '' }}" placeholder="Masukan deskripsi produk..."></x-forms.input-grid>

<x-forms.input-grid col1="2" col2="6" label="Harga Beli" name="product_price_capital"
    value="{{ $product->product_price_capital ?? '' }}" placeholder="Masukan harga beli produk..."></x-forms.input-grid>

<x-forms.input-grid col1="2" col2="6" label="Harga Jual" name="product_price_sell"
    value="{{ $product->product_price_sell ?? '' }}" placeholder="Masukan harga jual produk..."></x-forms.input-grid>




@push('script')
    <script src="{{ asset('assets/js/apps/user.js?v=' . random_string(6)) }}"></script>
@endpush
