<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\FilterGroupResource;
use App\Http\Resources\ServiceResource;
use App\Models\FilterGroup;
use App\Models\Service;
use App\Models\ServiceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    function index(Request $request)
    {
        $limit = $request->has("limit") ? $request->get("limit") : 20;
        $offset = $request->has("offset") ? $request->get("offset") : 0;
        $filter_groups_types = FilterGroup::all()->keyBy("id")->map(function ($group){
            return $group->type;
        })->toArray();
        $services = [];
        foreach (ServiceFilter::all() as $service_filter){
            $services[$service_filter['service_id']][] = $service_filter['filter_id'];
        }
        $services = collect($services);
        if ($request->has('filter_id')) {
            $filters = $request->get('filter_id');
            foreach ($filters as $group_id => $filter_ids) {
                if ($filter_groups_types[$group_id] == FilterGroup::TYPE_CHECKBOX || $filter_groups_types[$group_id] == FilterGroup::TYPE_RANGE) {
                    $services = $services->filter(function ($item) use ($filter_ids){
                        $t = false;
                        while($t === false && count($filter_ids) > 0){
                            $t = in_array(array_pop($filter_ids),$item);
                        }
                        return $t;
                    });
                } else {
                    $services = $services->filter(function ($item) use ($filter_ids){
                        return in_array($filter_ids,$item);
                    });
                }
            }
            $services_ids = $services->keys();
        }else{
            $services_ids = Service::all()->map(function (Service $service){
                return $service->id;
            });
        }

        $service_collection = Service::query()
            ->whereIn("id", $services_ids)
            ->with("company")
            ->limit($limit)
            ->offset($offset)
            ->get();
        $count = Service::query()
            ->whereIn("id", $services_ids)
            ->count();
        return $this->response([
            'items' => ServiceResource::collection($service_collection),
            'filters' => $this->filters($services_ids),
            'count' => $count,
        ]);
    }

    private function filters($service_ids)
    {
        $query = ServiceFilter::query()
            ->select(["filter_id",DB::raw("count(service_id) as count")]);
        if(count($service_ids)){
            $query = $query->whereIn("service_id",$service_ids);
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
        $service = Service::query()->where("seo_url", $seo_url)->firstOrFail();
        return $this->response(ServiceResource::make($service));
    }
}
