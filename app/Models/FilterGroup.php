<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    use HasFactory;
    public $timestamps = false;

    const TYPES = ['checkbox','radio','select'];

    const TYPE_CHECKBOX = "checkbox";
    const TYPE_RADIO = "radio";
    const TYPE_SELECT = "select";

    protected $casts = [
        "position" => "integer"
    ];

    protected $fillable = [
        'title',
        'position',
        'type',
        'name'
    ];

    function items(){
        return $this->hasMany(FilterItem::class,"group_id","id");
    }

}
