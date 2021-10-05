<?php

namespace Database\Seeders;

use App\Models\CalendarDay;
use App\Models\FilterGroup;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filters = FilterGroup::query()->with("items")->get();
        User::companies()->each(function ($user) use ($filters){
            $services = Service::factory()->count(rand(1,10))->make();
            $user->services()->saveMany($services);
            foreach ($user->services as $service){
                foreach ($filters as $filter){
                    if($filter->type == "checkbox"){
                        if($filter->id == 4){
                            $items = $filter->items->skip(rand(0,2))->take(rand(1,3));
                        }else{
                            $items = $filter->items->random(rand(1,3));
                        }
                        foreach ($items as $item){
                            $service->filters()->create(['filter_id' => $item->id]);
                        }
                    }
                    if($filter->type == "select"){
                        $item = $filter->items->random(1)->first();
                        $service->filters()->create(['filter_id' => $item->id]);
                    }
                }
            }
        });
    }
}
