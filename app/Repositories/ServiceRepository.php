<?php

namespace App\Repositories;

use App\Http\Resources\ServiceResource;
use App\Repositories\BaseRepository;

class ServiceRepository extends BaseRepository
{
	protected $resource = ServiceResource::class;
}
