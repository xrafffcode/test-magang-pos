<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductService extends BaseService
{
    /**
     * Generate query index page
     *
     * @param Request $request
     */
    private function generate_query_get(Request $request)
    {
        $column_search = ["product_name", "product_description", "product_price_capital", "product_price_sell"];
        $column_order = [NULL, "product_name", "product_description", "product_price_capital", "product_price_sell"];
        $order = ["id" => "DESC"];

        $results = Product::query()
            ->where(function ($query) use ($request, $column_search) {
                $i = 1;
                if (isset($request->search)) {
                    foreach ($column_search as $column) {
                        if ($request->search["value"]) {
                            if ($i == 1) {
                                $query->where($column, "LIKE", "%{$request->search["value"]}%");
                            } else {
                                $query->orWhere($column, "LIKE", "%{$request->search["value"]}%");
                            }
                        }
                        $i++;
                    }
                }
            });

        if (isset($request->order) && !empty($request->order)) {
            $results = $results->orderBy($column_order[$request->order["0"]["column"]], $request->order["0"]["dir"]);
        } else {
            $results = $results->orderBy(key($order), $order[key($order)]);
        }

        return $results;
    }

    public function get_list_paged(Request $request)
    {
        $results = $this->generate_query_get($request);
        if ($request->length != -1) {
            $results = $results->offset($request->start)->limit($request->length);
        }
        return $results->get();
    }

    public function get_list_all(Request $request)
    {
        $results = $this->generate_query_get($request);
        return $results->get();
    }

    public function get_detail($id)
    {
        return Product::find($id);
    }

    public function get_list_count(Request $request)
    {
        $results = $this->generate_query_get($request);
        return $results->count();
    }

    public function store(ProductRequest $request)
    {
        try {

            $value = $request->validated();

            $product = Product::create($value);


            $response = \response_success_default("Berhasil menambahkan produk!", false, route("app.products.index"));
        } catch (\Exception $e) {
            ErrorService::error($e, "Gagal store user!");

            $response = \response_errors_default();
        }

        return $response;
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = Product::find($product->id);

            $product->update($request->all());

            $response = \response_success_default("Berhasil mengubah produk!", false, route("app.products.index"));
        } catch (\Exception $e) {
            ErrorService::error($e, "Gagal update produk!");

            $response = \response_errors_default();
        }

        return $response;
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();

            $response = \response_success_default("Berhasil menghapus produk!");
        } catch (\Exception $e) {
            ErrorService::error($e, "Gagal menghapus produk!");

            $response = \response_errors_default();
        }

        return $response;
    }
}
