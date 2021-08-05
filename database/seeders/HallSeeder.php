<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\CalendarDay;
use App\Models\FilterGroup;
use App\Models\FilterItem;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
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
            $halls = Hall::factory()->count(rand(1,10))->make();
            $user->halls()->saveMany($halls);
            foreach ($user->halls as $hall){
                $hall->calendar->days()->saveMany(CalendarDay::factory()->count(rand(3,10))->make());
                foreach ($filters as $filter){
                    if($filter->type == "checkbox"){
                        if($filter->id == 4){
                            $items = $filter->items->skip(rand(0,2))->take(rand(1,3));
                        }else{
                            $items = $filter->items->random(rand(1,3));
                        }
                        foreach ($items as $item){
                            $hall->filters()->create(['filter_id' => $item->id]);
                        }
                    }
                    if($filter->type == "select"){
                        $item = $filter->items->random(1)->first();
                        $hall->filters()->create(['filter_id' => $item->id]);
                    }
                }
            }
        });
    }
}
