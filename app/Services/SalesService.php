<?php

namespace App\Services;

use App\Http\Requests\SalesRequest;
use App\Models\Order;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class SalesService extends BaseService
{
    /**
     * Generate query index page
     *
     * @param Request $request
     */
    private function generate_query_get(Request $request)
    {
        $column_search = ["order_number", "order_date", "order_total"];
        $column_order = [NULL, "order_number", "order_date", "order_total"];
        $order = ["id" => "DESC"];

        $results = Order::query()
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
        $results = Order::query()
            ->where("id", $id)
            ->first();
        return $results;
    }

    public function get_list_count(Request $request)
    {
        $results = $this->generate_query_get($request);
        return $results->count();
    }


    public function store(SalesRequest $request)
    {
        try {
            $value = $request->validated();

            DB::beginTransaction();

            $order = Order::create([
                'order_number' =>   "ORD" . date("YmdHis"),
                'order_date' => $value['order_date'],
            ]);

            $order_total = 0;

            foreach ($value['order_items'] as $item) {
                $itemArray = json_decode($item, true);
                $order_total += $itemArray['quantity'] * $itemArray['price'];

                $order->order_items()->create([
                    'product_id' => $itemArray['product_id'],
                    'quantity' => $itemArray['quantity'],
                    'price' => $itemArray['price'],
                    'total' => $itemArray['quantity'] * $itemArray['price'],
                ]);
            }

            $order->update(['order_total' => $order_total]);

            DB::commit();

            $response = \response_success_default("Berhasil menambahkan penjualan!", false, route("app.sales.index"));
        } catch (\Exception $e) {
            DB::rollBack();

            ErrorService::error($e, 'Gagal store order!');

            $response = response_errors_default();
        }

        return $response;
    }
}
