<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterItem extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'title',
        'group_id',
        'position',
    ];

    function filter_group(){
        return $this->belongsTo(FilterGroup::class,"group_id","id");
    }
}
