<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalendarDayStoreRequest;
use App\Http\Requests\CalendarDayUpdateRequest;
use App\Models\CalendarDay;
use App\Repositories\CalendarDayRepository;
use Illuminate\Http\Request;

class AdminCalendarDayController extends AdminBaseController
{
    protected $requests = [
        'store' => CalendarDayStoreRequest::class,
        'update' => CalendarDayUpdateRequest::class,
    ];

    protected $model = CalendarDay::class;

    function __construct()
    {
        $this->repository = new CalendarDayRepository($this->model);
    }
}
