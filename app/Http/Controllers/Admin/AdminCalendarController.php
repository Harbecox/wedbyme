<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarStoreRequest;
use App\Http\Requests\CalendarUpdateRequest;
use App\Models\Calendar;
use App\Repositories\CalendarRepository;
use Illuminate\Http\Request;

class AdminCalendarController extends AdminBaseController
{
    protected $requests = [
        'store' => CalendarStoreRequest::class,
        'update' => CalendarUpdateRequest::class,
    ];

    protected $model = Calendar::class;

    function __construct()
    {
        $this->repository = new CalendarRepository($this->model);
    }
}
