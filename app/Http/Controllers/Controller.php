<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\ViewModels\JsonResult;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonFaultResult($message){
        return json_encode(new JsonResult(null,false, $message));
    }

    protected function jsonSuccessResult($data = null, $message = null){
        return json_encode(new JsonResult($data, true, $message));
    }
}
