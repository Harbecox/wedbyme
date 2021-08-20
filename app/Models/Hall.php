<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * App\Models\Hall
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Calendar[] $calendar
 * @property-read int|null $calendar_count
 * @property mixed $attributes
 * @property mixed $coords
 * @property mixed $guest_count
 * @property mixed $images
 * @property mixed $phones
 * @property mixed $price
 * @property mixed $types
 * @method static \Database\Factories\HallFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall query()
 * @mixin \Eloquent
 */
class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_id",
        "images",
        "coords",
        "phones",
        "address",
        "review",
        "calendar_id",
        "seo_url",
        "title",
        "urls"
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
        return $this->hasMany(HallFilter::class,"hall_id","id");
    }

    function getImagesAttribute($value){
        return collect(json_decode($value,true))->map(function ($image){
            return URL::to("public/images/".$image);
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

    function getCoordsAttribute($value){
        return json_decode($value,true);
    }

    function setCoordsAttribute($arr){
        $arr = collect($arr)->map(function ($item){
            return intval($item);
        });
        $this->attributes['coords'] = json_encode($arr,256);
    }

    function getPhonesAttribute($value){
        return json_decode($value,true);
    }

    function setPhonesAttribute($arr){
        $this->attributes['phones'] = json_encode($arr,256);
    }

    function getReviewAttribute($value){
        return intval($value);
    }

    function company(){
        return $this->belongsTo(User::class,"company_id","id");
    }

}
