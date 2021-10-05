<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function index(){
        $companies = User::companies();
        return $this->response(CompanyResource::collection($companies));
    }

    function show($seo_url){
        $company = User::query()->where("seo_url",$seo_url)->with("halls")->with("services")->firstOrFail();
        return $this->response(CompanyResource::make($company));
    }
}
