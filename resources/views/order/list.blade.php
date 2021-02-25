<table class="table-bordered w-100">
    <thead>
    <tr>
        <th><small>Название</small></th>
        <th><small>Кол-во</small></th>
        <th><small>Цена</small></th>
    </tr>
    </thead>

    @foreach(GetList($id)->product as $produc)
        <tr>
            <td>{{$produc->name}}</td>
            <td>{{$produc->pivot->quantity}}</td>
            <td>{{$produc->pivot->price}}</td>
        </tr>
    @endforeach

</table>