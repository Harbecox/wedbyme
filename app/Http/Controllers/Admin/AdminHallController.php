<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HallStoreRequest;
use App\Http\Requests\HallUpdateRequest;
use App\Models\Hall;
use App\Repositories\HallRepository;
use Illuminate\Http\Request;

class AdminHallController extends AdminBaseController
{
    protected $requests = [
        'store' => HallStoreRequest::class,
        'update' => HallUpdateRequest::class,
    ];

    protected $model = Hall::class;

    function __construct()
    {
        $this->repository = new HallRepository($this->model);
    }

    function filter_update($hall_id,Request $request){
        $hall = Hall::find($hall_id);
        $filter_ids = $request->get("filter_ids",[]);
        $hall->filters()->delete();
        foreach ($filter_ids as $id){
            $hall->filters()->create(['filter_id' => $id]);
        }
        return $this->updateResponse();
    }

}
