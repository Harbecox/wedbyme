<?php

namespace App\Models;

use App\Repositories\ServiceFilterRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "images",
        "phones",
        "review",
        "calendar_id",
        "seo_url",
        "title",
        "urls",
        "description"
    ];

    const searchable = [
        'title',
        'phone',
        'email',
        'title',
        'seo_url'
    ];

    protected $casts = [
        "review" => 'float'
    ];

    function calendar(){
        return $this->hasOne(Calendar::class,"id","calendar_id")->with("days");
    }

    function filters(){
        return $this->hasMany(ServiceFilter::class,"service_id","id");
    }

    function getImagesAttribute($value){
        return collect(json_decode($value,true))->map(function ($image){
            return URL::to("image/".$image);
        });
    }

    function setImagesAttribute($arr){
        $this->attributes['images'] = json_encode($arr,256);
    }

    function getUrlsAttribute($value){
        return json_decode($value,true) ?? array();
    }

    function setUrlsAttribute($arr){
        $this->attributes['urls'] = json_encode($arr,256);
    }

    function getPhonesAttribute($value){
        return json_decode($value,true);
    }

    function setPhonesAttribute($arr){
        $this->attributes['phones'] = json_encode($arr,256);
    }

    function getReviewAttribute($value){
        return intval($value * 10);
    }

    function company(){
        return $this->belongsTo(User::class,"company_id","id");
    }
}
