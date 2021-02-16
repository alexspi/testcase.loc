<?php

namespace App\Http\Controllers;

use App\Jobs\CheckDelivery;

class IndexController extends Controller
{
    public function check()
    {
        CheckDelivery::dispatch();
        return redirect()->back();
    }
}
