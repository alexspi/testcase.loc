@extends('layouts.app')

@section('content')
    <section class="mt-5">
        <div class="container">
            <a class="btn btn-info mb-3" href="/check">Проверить просроченные</a>
            <table class="table-striped table-hover w-100 text-center">
                <thead class="thead-dark">
                <tr>
                    <th>ID заказа</th>
                    <th>Партнер</th>
                    <th>Сумма заказа</th>
                    <th>Состав заказа</th>
                    <th>Статус заказа</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><a href="{{ url('orders/' . $order->id . '/edit') }}" target="_blank">{{$order->id}}</a>
                        </td>
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
                                        <td>{{$product->pivot->quantity}}</td>
                                        <td>{{$product->pivot->price}}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </td>

                        <td>{!! OrderStatus($order->status)!!}</td>

                    </tr>
                @endforeach
                </tbody>

            </table>
            {{ $orders->links() }}
        </div>

        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
            {{--            <div class="container">--}}
            {{--                <ul class="nav nav-tabs" id="myTab" role="tablist">--}}
            {{--                    <li class="nav-item" role="presentation">--}}
            {{--                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item" role="presentation">--}}
            {{--                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item" role="presentation">--}}
            {{--                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Messages</a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item" role="presentation">--}}
            {{--                        <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}

            {{--                <!-- Tab panes -->--}}
            {{--                <div class="tab-content">--}}
            {{--                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}
            {{--                        <table class="table-striped table-hover w-100 text-center">--}}
            {{--                            <thead class="thead-dark">--}}
            {{--                            <th>ID заказа</th>--}}
            {{--                            <th>Партнер</th>--}}
            {{--                            <th>Сумма заказа</th>--}}
            {{--                            <th>Состав заказа</th>--}}
            {{--                            <th>Статус заказа</th>--}}
            {{--                            </thead>--}}
            {{--                            <tbody>--}}
            {{--                            @foreach($new as $order)--}}
            {{--                                <tr>--}}
            {{--                                    <td><a href="{{ url('orders/' . $order->id . '/edit') }}" target="_blank">{{$order->id}}</a>--}}
            {{--                                    </td>--}}
            {{--                                    <td>{{$order->partner->name}}</td>--}}
            {{--                                    <td>{{SummOrder($order)}}</td>--}}
            {{--                                    <td>--}}
            {{--                                        <table class="table-bordered w-100">--}}
            {{--                                            <thead>--}}
            {{--                                            <th><small>Название</small></th>--}}
            {{--                                            <th><small>Кол-во</small></th>--}}
            {{--                                            <th><small>Цена</small></th>--}}

            {{--                                            </thead>--}}
            {{--                                            @foreach($order->product as $product)--}}
            {{--                                                <tr>--}}
            {{--                                                    <td>{{$product->name}}</td>--}}
            {{--                                                    <td>{{$product->quant->quantity}}</td>--}}
            {{--                                                    <td>{{$product->quant->price}}</td>--}}
            {{--                                                </tr>--}}
            {{--                                            @endforeach--}}

            {{--                                        </table>--}}
            {{--                                    </td>--}}

            {{--                                    <td>{!! OrderStatus($order->status)!!}</td>--}}

            {{--                                </tr>--}}
            {{--                            @endforeach--}}
            {{--                            </tbody>--}}

            {{--                        </table>--}}
            {{--                        {{ $new->links() }}--}}
            {{--                    </div>--}}
            {{--                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">--}}
            {{--                        <table class="table-striped table-hover w-100 text-center">--}}
            {{--                            <thead class="thead-dark">--}}
            {{--                            <th>ID заказа</th>--}}
            {{--                            <th>Партнер</th>--}}
            {{--                            <th>Сумма заказа</th>--}}
            {{--                            <th>Состав заказа</th>--}}
            {{--                            <th>Статус заказа</th>--}}
            {{--                            </thead>--}}
            {{--                            <tbody>--}}
            {{--                            @foreach($expired as $order)--}}
            {{--                                <tr>--}}
            {{--                                    <td><a href="{{ url('orders/' . $order->id . '/edit') }}" target="_blank">{{$order->id}}</a>--}}
            {{--                                    </td>--}}
            {{--                                    <td>{{$order->partner->name}}</td>--}}
            {{--                                    <td>{{SummOrder($order)}}</td>--}}
            {{--                                    <td>--}}
            {{--                                        <table class="table-bordered w-100">--}}
            {{--                                            <thead>--}}
            {{--                                            <th><small>Название</small></th>--}}
            {{--                                            <th><small>Кол-во</small></th>--}}
            {{--                                            <th><small>Цена</small></th>--}}

            {{--                                            </thead>--}}
            {{--                                            @foreach($order->product as $product)--}}
            {{--                                                <tr>--}}
            {{--                                                    <td>{{$product->name}}</td>--}}
            {{--                                                    <td>{{$product->quant->quantity}}</td>--}}
            {{--                                                    <td>{{$product->quant->price}}</td>--}}
            {{--                                                </tr>--}}
            {{--                                            @endforeach--}}

            {{--                                        </table>--}}
            {{--                                    </td>--}}

            {{--                                    <td>{!! OrderStatus($order->status)!!}</td>--}}

            {{--                                </tr>--}}
            {{--                            @endforeach--}}
            {{--                            </tbody>--}}

            {{--                        </table>--}}
            {{--                        {{ $expired->links() }}--}}
            {{--                    </div>--}}
            {{--                    <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">--}}
            {{--                        <table class="table-striped table-hover w-100 text-center">--}}
            {{--                            <thead class="thead-dark">--}}
            {{--                            <th>ID заказа</th>--}}
            {{--                            <th>Партнер</th>--}}
            {{--                            <th>Сумма заказа</th>--}}
            {{--                            <th>Состав заказа</th>--}}
            {{--                            <th>Статус заказа</th>--}}
            {{--                            </thead>--}}
            {{--                            <tbody>--}}
            {{--                            @foreach($now as $order)--}}
            {{--                                <tr>--}}
            {{--                                    <td><a href="{{ url('orders/' . $order->id . '/edit') }}" target="_blank">{{$order->id}}</a>--}}
            {{--                                    </td>--}}
            {{--                                    <td>{{$order->partner->name}}</td>--}}
            {{--                                    <td>{{SummOrder($order)}}</td>--}}
            {{--                                    <td>--}}
            {{--                                        <table class="table-bordered w-100">--}}
            {{--                                            <thead>--}}
            {{--                                            <th><small>Название</small></th>--}}
            {{--                                            <th><small>Кол-во</small></th>--}}
            {{--                                            <th><small>Цена</small></th>--}}

            {{--                                            </thead>--}}
            {{--                                            @foreach($order->product as $product)--}}
            {{--                                                <tr>--}}
            {{--                                                    <td>{{$product->name}}</td>--}}
            {{--                                                    <td>{{$product->quant->quantity}}</td>--}}
            {{--                                                    <td>{{$product->quant->price}}</td>--}}
            {{--                                                </tr>--}}
            {{--                                            @endforeach--}}

            {{--                                        </table>--}}
            {{--                                    </td>--}}

            {{--                                    <td>{!! OrderStatus($order->status)!!}</td>--}}

            {{--                                </tr>--}}
            {{--                            @endforeach--}}
            {{--                            </tbody>--}}

            {{--                        </table>--}}
            {{--                        {{ $now->links() }}--}}
            {{--                    </div>--}}
            {{--                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">--}}
            {{--                        <table class="table-striped table-hover w-100 text-center">--}}
            {{--                            <thead class="thead-dark">--}}
            {{--                            <th>ID заказа</th>--}}
            {{--                            <th>Партнер</th>--}}
            {{--                            <th>Сумма заказа</th>--}}
            {{--                            <th>Состав заказа</th>--}}
            {{--                            <th>Статус заказа</th>--}}
            {{--                            </thead>--}}
            {{--                            <tbody>--}}
            {{--                            @foreach($ended as $order)--}}
            {{--                                <tr>--}}
            {{--                                    <td><a href="{{ url('orders/' . $order->id . '/edit') }}" target="_blank">{{$order->id}}</a>--}}
            {{--                                    </td>--}}
            {{--                                    <td>{{$order->partner->name}}</td>--}}
            {{--                                    <td>{{SummOrder($order)}}</td>--}}
            {{--                                    <td>--}}
            {{--                                        <table class="table-bordered w-100">--}}
            {{--                                            <thead>--}}
            {{--                                            <th><small>Название</small></th>--}}
            {{--                                            <th><small>Кол-во</small></th>--}}
            {{--                                            <th><small>Цена</small></th>--}}

            {{--                                            </thead>--}}
            {{--                                            @foreach($order->product as $product)--}}
            {{--                                                <tr>--}}
            {{--                                                    <td>{{$product->name}}</td>--}}
            {{--                                                    <td>{{$product->quant->quantity}}</td>--}}
            {{--                                                    <td>{{$product->quant->price}}</td>--}}
            {{--                                                </tr>--}}
            {{--                                            @endforeach--}}

            {{--                                        </table>--}}
            {{--                                    </td>--}}

            {{--                                    <td>{!! OrderStatus($order->status)!!}</td>--}}

            {{--                                </tr>--}}
            {{--                            @endforeach--}}
            {{--                            </tbody>--}}

            {{--                        </table>--}}
            {{--                        {{ $ended->links() }}--}}
            {{--                    </div>--}}
            {{--                </div>--}}


            {{--        </div>--}}
        </div>
    </section>
    <script>
        $('#myTab a').on('click', function (event) {
            event.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection
