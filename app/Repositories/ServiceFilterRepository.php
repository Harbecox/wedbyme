<?php

namespace App\Repositories;

use App\Http\Resources\ServiceFilterResource;
use App\Repositories\BaseRepository;

class ServiceFilterRepository extends BaseRepository
{
	protected $resource = ServiceFilterResource::class;
}
