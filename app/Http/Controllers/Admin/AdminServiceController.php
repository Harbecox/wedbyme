<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hall;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Illuminate\Http\Request;

class AdminServiceController extends AdminBaseController
{
	protected $requests = [
		'store' => ServiceStoreRequest::class,
		'update' => ServiceUpdateRequest::class,
	];

	protected $model = Service::class;

	function __construct()
	{
		$this->repository = new ServiceRepository($this->model);
	}

    function filter_update($service_id,Request $request){
        $service = Service::find($service_id);
        $filter_ids = $request->get("filter_ids",[]);
        $service->filters()->delete();
        foreach ($filter_ids as $id){
            $service->filters()->create(['filter_id' => $id]);
        }
        return $this->updateResponse();
    }
}
