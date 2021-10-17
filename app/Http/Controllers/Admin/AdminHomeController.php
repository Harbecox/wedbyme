<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use App\Models\Home;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    function index(){
        $arrays = Home::all()->keyBy("name")->map(function ($item) {
            return $item->item;
        });
        $arrays['companies'] = CompanyResource::collection(User::query()->whereIn("id", $arrays['companies'])->get());
        $arrays['halls'] = HallResource::collection(Hall::query()->whereIn("id", $arrays['halls'])->get());
        $arrays['services'] = HallResource::collection(Service::query()->whereIn("id", $arrays['services'])->get());
        $slider = [];
        foreach ($arrays['slider'] as $slide){
            $slider[] = json_decode($slide,true);
        }
        $arrays['slider'] = $slider;
        return $this->response($arrays);
    }

    function update(Request $request){
        $data = [];
        if($request->has('companies')){
            $data['companies'] = $request->get("companies",[]);
        }
        if($request->has('halls')){
            $data['halls'] = $request->get("halls",[]);
        }
        if($request->has('services')){
            $data['services'] = $request->get("services",[]);
        }
        if($request->has('slider')){
            $data['slider'] = $request->get("slider",[]);
        }

        foreach ($data as $name => $items){
            Home::query()->where("name",$name)->update(['item' => $items]);
        }

        return $this->index();

    }
}
