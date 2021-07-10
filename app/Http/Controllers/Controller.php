<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function response($data = null,$http_status = Response::HTTP_OK,$headers = []){
        switch (request()->method()){
            case "POST":
                $http_status = ($http_status == Response::HTTP_OK) ? Response::HTTP_CREATED : $http_status;
                break;
            case "PUT":
                $http_status = ($http_status == Response::HTTP_OK) ? Response::HTTP_NO_CONTENT : $http_status;
                break;
            case "DELETE":
                $http_status = ($http_status == Response::HTTP_OK) ? Response::HTTP_NO_CONTENT : $http_status;
                break;
        }
        return response()->json($data,$http_status,$headers);
    }

}
