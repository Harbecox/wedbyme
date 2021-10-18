<?php

namespace App\Repositories;

use App\Http\Resources\CompanyResource;
use App\Mail\NewCompanyMail;
use App\Mail\ServiceMail;
use Illuminate\Support\Facades\Mail;

class CompanyRepository extends BaseRepository
{
    protected $resource = CompanyResource::class;

    function add($data)
    {
        $user = $this->model::create($data);
        Mail::to($user)->send(new NewCompanyMail($data['password'],$user));
        return  $user;
    }
}
