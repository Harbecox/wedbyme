<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterGroupStoreRequest;
use App\Http\Requests\FilterGroupUpdateRequest;
use App\Models\FilterGroup;
use App\Repositories\FilterGroupRepository;
use Illuminate\Http\Request;

class AdminFilterGroupController extends AdminBaseController
{
    protected $requests = [
        'store' => FilterGroupStoreRequest::class,
        'update' => FilterGroupUpdateRequest::class
    ];

    protected $model = FilterGroup::class;

    function __construct()
    {
        $this->repository = new FilterGroupRepository($this->model);
    }
}
