<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HallStoreRequest;
use App\Http\Requests\HallUpdateRequest;
use App\Models\Hall;
use App\Repositories\HallRepository;

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



}
