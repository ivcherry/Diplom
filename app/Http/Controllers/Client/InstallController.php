<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallController extends Controller{

    public function index(){
        return view('client.install.index');
    }

    public function thanksPage(){
        return view('client.install.thanksPage');
    }

}
