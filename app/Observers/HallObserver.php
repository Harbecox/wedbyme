<?php

namespace App\Observers;

use App\Models\Hall;
use Illuminate\Support\Str;

class HallObserver
{
    /**
     * Handle the Hall "created" event.
     *
     * @param  \App\Models\Hall  $hall
     * @return void
     */
    public function created(Hall $hall)
    {
        $calendar = $hall->calendar()->create();
        $hall->calendar_id = $calendar->id;
        $hall->save();
    }

    public function creating(Hall $hall){
        if(!$hall->seo_url){
            $slug = Str::slug($hall->title);
            if(!$this->slugUnique($slug)){
                $slug = $hall->company->title."-".$slug;
            }
            if(!$this->slugUnique($slug)){
                $slug = $slug."-".rand(10,99);
            }
            $hall->seo_url = $slug;
        }
        return $hall;
    }

    function slugUnique($slug){
        return !Hall::query()->where("seo_url",$slug)->exists();
    }

    /**
     * Handle the Hall "updated" event.
     *
     * @param  \App\Models\Hall  $hall
     * @return void
     */
    public function updated(Hall $hall)
    {
        //
    }

    /**
     * Handle the Hall "deleted" event.
     *
     * @param  \App\Models\Hall  $hall
     * @return void
     */
    public function deleted(Hall $hall)
    {
        //
    }

    /**
     * Handle the Hall "restored" event.
     *
     * @param  \App\Models\Hall  $hall
     * @return void
     */
    public function restored(Hall $hall)
    {
        //
    }

    /**
     * Handle the Hall "force deleted" event.
     *
     * @param  \App\Models\Hall  $hall
     * @return void
     */
    public function forceDeleted(Hall $hall)
    {
        //
    }
}
