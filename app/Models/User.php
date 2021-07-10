<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property-read mixed $logo
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hall[] $halls
 * @property-read int|null $halls_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-write mixed $password
 * @property-read User $user
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        "title",
        "phone",
        "about",
        "logo",
        "role"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    const ROLE_ADMIN = "admin";
    const ROLE_COMPANY = "company";
    const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_COMPANY
    ];

    function halls(){
        return $this->hasMany(Hall::class,"company_id","id")->with("calendar");
    }

    static function companies(){
        return User::query()->where("role",self::ROLE_COMPANY)->get();
    }

    function getLogoAttribute($value){
        return $value ? URL::to("public/images/".$value) : null;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
