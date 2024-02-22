<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SalesRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\SalesService;

class SalesController extends Controller
{
    private SalesService $sales_service;

    public function __construct()
    {
        $this->sales_service = new SalesService;
    }

    /**
     * Get list product
     *
     * @param Request $request
     */
    public function get(Request $request)
    {
        $orders = $this->sales_service->get_list_paged($request);
        $count = $this->sales_service->get_list_count($request);

        $data = [];
        $no = $request->start;

        foreach ($orders as $order) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $order->order_number;
            $row[] = $order->order_date;
            $row[] = $order->formatted_total;
            $button = "<a href='" . \route("app.sales.show", $order->id) . "' class='btn btn-info btn-sm m-1'>Detail</a>";
            $button .= form_delete("formOrder$order->id", route("app.sales.destroy", $order->id));
            $row[] = $button;
            $data[] = $row;
        }

        $output = [
            "draw" => $request->draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data
        ];

        return \response()->json($output, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view_admin("admin.sales.index", "Sales Management", [], TRUE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::query()
            ->select("id", "product_name", "product_price_sell")
            ->get();

        return $this->view_admin("admin.sales.create", "Create Sales", [
            "products" => $products
        ], TRUE);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesRequest $request)
    {

        $response = $this->sales_service->store($request);

        return \response_json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $order = Order::query()
            ->with("order_items.product")
            ->find($order_id);

        $data = [
            "order" => $order
        ];

        return $this->view_admin("admin.sales.show", "Detail Sales", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = Order::find($id);

        $sales->delete();

        $response = \response_success_default("Berhasil menghapus penjualan!", FALSE, \route("app.sales.index"));

        return \response_json($response);
    }
}
