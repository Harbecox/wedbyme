<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use App\Models\Home;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $arrays = Home::all()->keyBy("name")->map(function ($item) {
            return $item->items;
        });
        $arrays['companies'] = CompanyResource::collection(User::query()->whereIn("id", $arrays['companies'])->get());
        $arrays['halls'] = HallResource::collection(Hall::query()->whereIn("id", $arrays['halls'])->get());
        $arrays['services'] = HallResource::collection(Service::query()->whereIn("id", $arrays['services'])->get());
        return $this->response($arrays);
    }

    function search(Request $request){

    }
}
