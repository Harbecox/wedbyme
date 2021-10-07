<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    function index(){
        $arrays = Home::all()->keyBy("name")->map(function ($item){
            return $item->items;
        });
        return $this->response($arrays);
    }

    function update(Request $request){
        $data['company'] = $request->get("company",[]);
        $data['hall'] = $request->get("hall",[]);
        $data['services'] = $request->get("services",[]);
        $data['slider'] = $request->get("slider",[]);

        foreach ($data as $name => $items){
            Home::query()->where("name",$name)->update($items);
        }

    }
}
