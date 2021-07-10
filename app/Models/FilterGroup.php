<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    use HasFactory;

    const TYPES = ['checkbox','radio','input','range','select'];

    protected $fillable = [
        'title',
        'position',
        'type',
        'options'
    ];

    function getOptionAttribute(){
        return json_decode($this->options,true);
    }

    function setOptionAttribute($value){
        $this->attributes['options'] = json_encode($value,256);
    }

    function items(){
        return $this->hasMany(FilterItem::class,"group_id","id");
    }

}
