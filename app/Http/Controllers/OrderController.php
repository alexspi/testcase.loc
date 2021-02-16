<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('product')->take(10)->paginate(50);

        return view('order.index', compact('orders'));
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
        $order->product()->sync($request->product);

        foreach ($request->product as $id_prod) {

            $q_up = OrderProduct::where('order_id', $order->id)->where('product_id', $id_prod)->first();
            $q_up->quantity = $request->quantity[$id_prod];
            $q_up->save();
        }
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
