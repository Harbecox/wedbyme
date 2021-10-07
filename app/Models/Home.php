<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Home extends Model
{
    use HasFactory;

    function getItemsAttribute($value){
        $arr = json_decode($value,true);
        if($this->name == "slider"){
            foreach ($arr as &$item){
                $item = Url::to("image/".$item);
            }
        }
        return $arr;
    }

    function setItemsAttribute($arr){
        $this->attributes['items'] = json_encode($arr,256);
    }
}
