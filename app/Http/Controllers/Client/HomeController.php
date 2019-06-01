<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
