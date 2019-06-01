<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class InstallController extends Controller
{

    public function index()
    {
        return view('client.install.index');
    }

    public function thanksPage()
    {
        return view('client.install.thanksPage');
    }

}
