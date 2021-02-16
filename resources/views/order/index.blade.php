@extends('main')
@section('content')
    <div class="mt-5">


        <div class="container">

            <table class="table-striped table-hover w-100 text-center">
                <thead class="thead-dark">
                <th>ID заказа</th>
                <th>Партнер</th>
                <th>Сумма заказа</th>
                <th>Состав заказа</th>
                <th>Статус заказа</th>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><a href="{{ url('orders/' . $order->id . '/edit') }}">{{$order->id}}</a></td>
                        <td>{{$order->partner->name}}</td>
                        <td>{{SummOrder($order)}}</td>
                        <td>
                            <table class="table-bordered w-100">
                                <thead>
                                <th><small>Название</small></th>
                                <th><small>Кол-во</small></th>
                                <th><small>Цена</small></th>

                                </thead>
                                @foreach($order->product as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->quant->quantity}}</td>
                                        <td>{{$product->quant->price}}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </td>

                        <td>{{OrderStatus($order->status)}}</td>

                    </tr>
                @endforeach
                </tbody>

            </table>
            {{ $orders->links() }}
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

        </div>
    </div>
@endsection
