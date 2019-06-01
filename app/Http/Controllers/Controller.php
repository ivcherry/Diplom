<?php

namespace App\Http\Controllers;

use App\ViewModels\JsonResult;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function jsonFaultResult($message)
    {
        return json_encode(new JsonResult(null, false, $message));
    }

    protected function jsonSuccessResult($data = null, $message = null)
    {
        return json_encode(new JsonResult($data, true, $message));
    }
}
