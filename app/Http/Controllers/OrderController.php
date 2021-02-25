<?php

namespace App\Http\Controllers;

use App\DataTables\OrdersDataTable;
use App\Jobs\SendEmail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function orderdt(OrdersDataTable $dataTable)
    {
        return $dataTable->render('order.dt');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('product')->paginate(50);


        $test = Order::with('product')->take(5)->first();


        $ended = Order::ofStatus('20')->paginate(50);
        $new = Order::ofStatus('0')->paginate(50);
        $now = Order::ofStatus('10')->paginate(50);
        $expired = Order::ofStatus('5')->paginate(50);

        return view('order.index', compact('orders', 'new', 'now', 'ended', 'expired'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $partners = Partner::all();

        return view('order.edit', compact('order', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $order = Order::find($id);
        $order->partner_id = $request->partner_id;
        $order->client_email = $request->client_email;

        $order->save();

        $products = (array)$request->product;
        $uuu = (array)$request->quantity;

        foreach ($products as $id_prod) {
            $syncData[$id_prod]['quantity'] = $uuu[$id_prod];
            $syncData[$id_prod]['price'] =Product::OfPrice($id_prod);
        }

//dd($syncData);
        $order->product()->sync($syncData);

        if ($request->status == 20) {
            SendEmail::dispatch($order);
        }

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
