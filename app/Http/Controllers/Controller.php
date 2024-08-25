<?php

namespace App\Http\Controllers;

use F9Web\ApiResponseHelpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function apiResponse($message = null, $error  = null, $status , $data = null)
    {
        return response([
            "message" => $message,
            'error' => $error,
            'data' => $data
        ] , $status);
    }
}
