<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Home extends Model
{
    use HasFactory;

    function getItemAttribute($value){
        return json_decode($value,true);
    }

    function setItemAttribute($arr){
        echo $arr[0];
        $this->attributes['item'] = json_encode($arr,256);
    }
}
