<?php

namespace App\Observers;

use App\Models\Hall;

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
