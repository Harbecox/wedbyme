<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $arrays = Home::all()->keyBy("name")->map(function ($item){
            return $item->items;
        });
        return $this->response($arrays);
    }
}
