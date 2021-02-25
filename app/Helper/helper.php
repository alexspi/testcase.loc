<?php
//use GuzzleHttp\Client as Guzzle;
//use GuzzleHttp\Psr7\Request;

use GuzzleHttp\Client as GuzzleClient;

function Yandex()
{
    $urlParams = [
        'lat' => 53.243325,
        'lon' => 34.363731,
        'extra' => true,

    ];
    $client = new GuzzleClient([
        'headers' => [
            'X-Yandex-API-Key' => 'b60bc4a0-5287-4704-9383-4b693a8ec7af',
        ],
    ]);

    $response = $client->request('GET', 'https://api.weather.yandex.ru/v2/forecast', ['query' => $urlParams]);

    $result = json_decode($response->getBody(), true);

    $city = $result['geo_object']['locality']['name'];
    $temp = $result['yesterday']['temp'];
    return "(Guzzle)В городе " . $city . " сейчас " . $temp;

}

function YandexPHP()
{

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Yandex-API-Key:b60bc4a0-5287-4704-9383-4b693a8ec7af']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://api.weather.yandex.ru/v2/forecast?lat=53.243325&lon=34.363731&extra=true');
    $respon = curl_exec($ch);
    curl_close($ch);
    $result1 = json_decode($respon, true);

    $city = $result1['geo_object']['locality']['name'];
    $temp = $result1['yesterday']['temp'];
    return "(php curl)В городе " . $city . " сейчас " . $temp;
}


function SummOrder($order)
{
    $summ = 0;
    foreach ($order->product as $item) {
        $summ = $item->pivot->quantity * $item->pivot->price;
    }
    return $summ;
}

function OrderStatus($status)
{
    if ($status === 20)
        return '<span class="badge badge-success">Выполнен</span>';
    elseif ($status === 0) {
        return '<span class="badge badge-info">Новый</span>';
    } elseif ($status === 10) {
        return '<span class="badge badge-primary">Текущий</span>';
    } else {
        return '<span class="badge badge-danger">Просрочен</span>';
    }

}

function GetList($id){

    return \App\Models\Order::whereId($id)->first();
}
?>
