<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterGroupStoreRequest;
use App\Http\Requests\FilterGroupUpdateRequest;
use App\Http\Requests\FilterStoreRequest;
use App\Http\Requests\FilterUpdateRequest;
use App\Models\FilterItem;
use App\Repositories\FilterGroupRepository;

use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class AdminFilterController extends AdminBaseController
{
    protected $requests = [
        'store' => FilterStoreRequest::class,
        'update' => FilterUpdateRequest::class
    ];

    protected $model = FilterItem::class;

    function __construct()
    {
        $this->repository = new FilterRepository($this->model);
    }
}
