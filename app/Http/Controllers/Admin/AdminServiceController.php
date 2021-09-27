<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;

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
}
