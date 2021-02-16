<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function check()
    {

        $today = Carbon::now();

        Order::where('delivery_dt', '<=', $today)->where('status', '<>', 20)->update(['status' => 5]);

        return redirect()->back();
    }
}
