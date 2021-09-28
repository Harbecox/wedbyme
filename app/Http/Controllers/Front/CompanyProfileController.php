<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyProfileController extends Controller
{

    private $company;

    function __construct()
    {
        $this->company = \Auth::user();
    }

    function index(){
        return $this->response(CompanyResource::make($this->company));
    }

    function update(Request $request){
        $data = $request->only("phone","password","title","logo","about");
        $this->company->update($data);
        return $this->response(null,Response::HTTP_NO_CONTENT);
    }

}
