<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    use HasFactory;
    public $timestamps = false;

    const TYPES = ['checkbox','radio','select','range'];

    const TYPE_CHECKBOX = "checkbox";
    const TYPE_RADIO = "radio";
    const TYPE_RANGE = "range";
    const TYPE_SELECT = "select";

    const CAT_SERVICE = "service";
    const CAT_HALL = "hall";

    const CATS = [self::CAT_SERVICE,self::CAT_HALL];

    protected $casts = [
        "position" => "integer"
    ];

    protected $fillable = [
        'title',
        'position',
        'type',
        'name',
        'cat'
    ];

    function items(){
        return $this->hasMany(FilterItem::class,"group_id","id")->orderBy("position");
    }

}
