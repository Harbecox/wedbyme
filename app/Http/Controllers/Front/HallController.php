<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilterGroupResource;
use App\Http\Resources\HallResource;
use App\Models\FilterGroup;
use App\Models\Hall;
use App\Models\HallFilter;
use Illuminate\Http\Request;

class HallController extends Controller
{
    function index(Request $request)
    {
        $limit = $request->has("limit") ? $request->get("limit") : 20;
        $offset = $request->has("offset") ? $request->get("offset") : 0;
        $filter_groups_types = FilterGroup::all()->keyBy("id")->map(function ($group){
            return $group->type;
        })->toArray();
        $query = HallFilter::query();
        if ($request->has('filter_id')) {
            $filters = $request->get('filter_id');
            foreach ($filters as $group_id => $filter_ids) {
                if ($filter_groups_types[$group_id] == FilterGroup::TYPE_CHECKBOX || $filter_groups_types[$group_id] == FilterGroup::TYPE_RANGE) {
                    $query = $query->where(function ($q) use ($filter_ids) {
                        foreach ($filter_ids as $id){
                            $q->orWhere("filter_id",$id);
                        }
                    });
                } else {
                    $query = $query->where("filter_id",$filter_ids);
                }
            }
            $hall_ids = $query->get()->map(function (HallFilter $hallFilter){
                return $hallFilter->hall_id;
            });
        }else{
            $hall_ids = Hall::all()->map(function (Hall $hall){
                return $hall->id;
            });
        }
        $halls_collection = Hall::query()
            ->whereIn("id", $hall_ids)
            ->with("company")
            ->limit($limit)
            ->offset($offset)
            ->get();

        return $this->response(HallResource::collection($halls_collection));
    }

    function filters()
    {
        return $this->response(FilterGroupResource::collection(FilterGroup::with("items")->get()));
    }

    function show($seo_url)
    {
        $hall = Hall::query()->where("seo_url", $seo_url)->firstOrFail();
        return $this->response(HallResource::make($hall));
    }
}
