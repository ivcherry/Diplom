<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class TuningController extends Controller
{

    public function index()
    {
        return view('client.tuning.index');
    }

}
