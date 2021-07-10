<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\CompanyStoreRequest;
use App\Models\CalendarDay;
use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminBaseController extends Controller
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    protected $requests = [];

    protected $model;

    public function index(Request $request)
    {
        $options = $request->query();
        $items = $this->repository->getAll($options);
        return $this->response($items);
    }

    public function store(Request $request)
    {
        $this->validation(__FUNCTION__);
        $data = $request->only($this->getModelFillable());
        $item = $this->repository->add($data);
        return $this->response($item);
    }

    public function show($id)
    {
        $item = $this->repository->get($id);
        return $this->response($item);
    }

    public function update(Request $request, $id)
    {
        $this->validation(__FUNCTION__);
        $data = $request->only($this->getModelFillable());
        $item = $this->repository->update($id,$data);
        return $this->response($item);
    }

    public function destroy($id)
    {
        $response = $this->repository->delete($id);
        return $this->response($response);
    }

    protected function validation($method){
        if(key_exists($method,$this->requests)){
            $rules = (new $this->requests[$method])->rules();
            \request()->validate($rules,\request()->all());
        }
    }

    function getModelFillable(){
        return (new $this->model())->getFillable();
    }

}
