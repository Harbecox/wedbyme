<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallFilter extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = null;

    protected $fillable = [
        "hall_id",
        "filter_id",
    ];

    protected $casts = [
        "hall_id"       => "integer",
        "filter_id"     => "integer",
    ];

    function filter(){
        return $this->belongsTo(FilterItem::class,"filter_id","id");
    }
}
