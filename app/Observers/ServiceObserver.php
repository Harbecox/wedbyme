<?php

namespace App\Observers;

use App\Models\Hall;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceObserver
{

    public function creating(Service $service){
        if(!$service->seo_url){
            $slug = Str::slug($service->title);
            if(!$this->slugUnique($slug)){
                $slug = $service->company->title."-".$slug;
            }
            if(!$this->slugUnique($slug)){
                $slug = $slug."-".rand(10,99);
            }
            $service->seo_url = $slug;
        }
        return $service;
    }

    function slugUnique($slug){
        return !Hall::query()->where("seo_url",$slug)->exists();
    }
    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        //
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        //
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        //
    }
}
