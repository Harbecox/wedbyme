<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallFilter extends Model
{
    use HasFactory;

    protected $fillable = [
        "hall_id",
        "filter_id",
        "value",
    ];

    function filter(){
        return $this->belongsTo(FilterItem::class,"filter_id","id");
    }
}
