<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFilter extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $incrementing = null;

    protected $fillable = [
        "service_id",
        "filter_id",
    ];

    function filter(){
        return $this->belongsTo(FilterItem::class,"filter_id","id");
    }
}
