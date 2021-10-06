<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallFilterStoreRequest;
use App\Http\Requests\HallFilterUpdateRequest;
use App\Models\Hall;
use App\Models\HallFilter;
use App\Repositories\HallFilterRepository;
use Illuminate\Http\Request;

class AdminHallFilterController extends AdminBaseController
{
    protected $requests = [
        'store' => HallFilterStoreRequest::class,
        'update' => HallFilterUpdateRequest::class,
    ];

    protected $model = HallFilter::class;

    function __construct()
    {
        $this->repository = new HallFilterRepository($this->model);
    }
}
