<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceFilter;
use App\Repositories\ServiceFilterRepository;
use App\Http\Requests\ServiceFilterStoreRequest;
use App\Http\Requests\ServiceFilterUpdateRequest;

class AdminServiceFilterController extends AdminBaseController
{
	protected $requests = [
		'store' => ServiceFilterStoreRequest::class,
		'update' => ServiceFilterUpdateRequest::class,
	];

	protected $model = ServiceFilter::class;

	function __construct()
	{
		$this->repository = new ServiceFilterRepository($this->model);
	}
}
