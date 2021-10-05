<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallStoreRequest;
use App\Http\Requests\HallUpdateRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\HallResource;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyProfileController extends Controller
{

    private $company;
    private $halls;
    private $services;

    function __construct()
    {
        $this->company = \Auth::user();
        $this->halls = $this->company->halls;
        $this->services = $this->company->services;
    }

    function index(){
        return $this->response(CompanyResource::make($this->company));
    }

    function update(Request $request){
        $data = $request->only("phone","password","title","logo","about");
        $this->company->update($data);
        return $this->updateResponse();
    }

    function store_hall(HallStoreRequest $request){
        $data = $request->all();
        $hall = $this->company->halls()->create($data);
        return HallResource::make($hall);
    }

    function update_hall(HallUpdateRequest $request,$id){
        $this->company->halls->find($id)->update($request->all());
        return $this->updateResponse();
    }

    function delete_hall($id){
        $this->company->halls->find($id)->delete();
        return $this->updateResponse();
    }

    function store_update_filters($id,Request $request){
        $hall = $this->company->halls->find($id);
        $filter_ids = $request->get("filter_ids",[]);
        $hall->filters()->delete();
        foreach ($filter_ids as $id){
            $hall->filters()->create(['filter_id' => $id]);
        }
    }

}
