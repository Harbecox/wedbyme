<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\User;
use App\Repositories\CompanyRepository;

class AdminCompanyController extends AdminBaseController
{
    protected $requests = [
        'store' => CompanyStoreRequest::class,
        'update' => CompanyUpdateRequest::class,
    ];

    protected $model = User::class;

    function __construct()
    {
        $this->repository = new CompanyRepository($this->model);
    }
}
