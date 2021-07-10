<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Calendar
 *
 * @method static \Database\Factories\CalendarFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Calendar query()
 * @mixin \Eloquent
 */
class Calendar extends Model
{
    use HasFactory;

    public $timestamps = false;

    function days(){
        return $this->hasMany(CalendarDay::class,"calendar_id","id");
    }
}
