<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilterGroupResource;
use App\Http\Resources\HallResource;
use App\Models\FilterGroup;
use App\Models\Hall;
use App\Models\HallFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HallController extends Controller
{
    function index(Request $request)
    {
        $limit = $request->has("limit") ? $request->get("limit") : 20;
        $offset = $request->has("offset") ? $request->get("offset") : 0;
        $filter_groups_types = FilterGroup::all()->keyBy("id")->map(function ($group){
            return $group->type;
        })->toArray();
        $halls = [];
        foreach (HallFilter::all() as $hall_filter){
            $halls[$hall_filter['hall_id']][] = $hall_filter['filter_id'];
        }
        $halls = collect($halls);
        if ($request->has('filter_id')) {
            $filters = $request->get('filter_id');
            foreach ($filters as $group_id => $filter_ids) {
                if ($filter_groups_types[$group_id] == FilterGroup::TYPE_CHECKBOX || $filter_groups_types[$group_id] == FilterGroup::TYPE_RANGE) {
                    $halls = $halls->filter(function ($item) use ($filter_ids){
                        $t = false;
                        while($t === false && count($filter_ids) > 0){
                            $t = in_array(array_pop($filter_ids),$item);
                        }
                        return $t;
                    });
                } else {
                    $halls = $halls->filter(function ($item) use ($filter_ids){
                        return in_array($filter_ids,$item);
                    });
                }
            }
            $hall_ids = $halls->keys();
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
        $count = Hall::query()
            ->whereIn("id", $hall_ids)
            ->count();
        return $this->response([
            'items' => HallResource::collection($halls_collection),
            'filters' => $this->filters($hall_ids),
            'count' => $count,
        ]);
    }

    private function filters($hall_ids)
    {
        $query =  HallFilter::query()
            ->select(["filter_id",DB::raw("count(hall_id) as count")]);
        if(count($hall_ids)){
            $query = $query->whereIn("hall_id",$hall_ids);
        }
        $counts = $query
            ->groupBy("filter_id")
            ->get()
            ->keyBy("filter_id")
            ->map(function ($item){
                return $item->count;
            });
        $filter_group = FilterGroup::with("items")->orderBy("position")->get()->map(function ($group) use ($counts){
            $group['items'] = $group->items->map(function ($item) use ($counts){
                $item['count'] = isset($counts[$item['id']]) ? $counts[$item['id']] : 0;
                return $item;
            });
            return $group;
        });
        return FilterGroupResource::collection($filter_group);
    }

    function show($seo_url)
    {
        $hall = Hall::query()->where("seo_url", $seo_url)->firstOrFail();
        return $this->response(HallResource::make($hall));
    }
}
