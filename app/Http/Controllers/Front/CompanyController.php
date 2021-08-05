<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function index(Request $request){
        $limit = $request->has("limit") ? $request->get("limit") : 20;
        $offset = $request->has("offset") ? $request->get("offset") : 0;
        $companies = User::query()->limit($limit)->offset($offset)->get();
    }

    function show($seo_url){
        $company = User::query()->where("seo_url",$seo_url)->firstOrFail();
        return $this->response(CompanyResource::make($company));
    }
}
