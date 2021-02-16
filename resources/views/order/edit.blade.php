@extends('main')
@section('content')

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


        <div class="container">

            <form method="POST" action="{{route('orders.update',$order)}}">
                @csrf
                <div class="form-group row">
                    <label for="client_email" class="col-sm-2 col-form-label">Email клиента</label>
                    <div class="col-sm-10">
                        <input type="email" name="client_email" id="client_email" class="form-control"
                               value="{{$order->client_email}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="partner_id" class="col-sm-2 col-form-label">Партнер</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="partner_id" name="partner_id">
                            @foreach($partners as $partner)
                                <option value="{{$partner->id}}"
                                        @if($order->partner_id ===$partner->id) selected @endif > {{$partner->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Статус</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="status" name="status">
                            <option value="0" @if($order->status ===0) selected @endif >Новый</option>
                            <option value="10" @if($order->status ===10) selected @endif >Текущий</option>
                            <option value="20" @if($order->status ===20) selected @endif >Выполненный</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <table class="table-bordered w-75 m-auto text-center">
                        <thead>
                        <th><small></small></th>
                        <th><small>Название</small></th>
                        <th><small>Кол-во</small></th>

                        </thead>
                        @foreach($order->product as $product)
                            <tr>
                                <td><input  type="checkbox" checked name="product[]" value="{{$product->id}}"></td>
                                <td>{{$product->name}}</td>
                                <td><input class="form-control" type="number" name="quantity[{{$product->id}}]" value="{{$product->quant->quantity}}"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Общая сумма заказа</td>

                            <td>{{SummOrder($order)}}</td>
                        </tr>
                    </table>
                </div>


                <div class="form-group">
                    <button type="submit">Сохранить</button>
                </div>
            </form>
        </div>
        <div class="flex justify-center mt-4 sm:items-center sm:justify-between">

        </div>
    </div>
@endsection
