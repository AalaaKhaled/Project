<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','phone','avatar','bio','website','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
        }
    public function authProviders() {
        return $this->hasMany('App\AuthProvider','user_id','id');
    }
     public function comments()
    {
        return $this->hasMany('App\Comment');
    }
     public function likes()
    {
        return $this->hasMany('App\Like');
    }
     public function following()
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'user_id');
    }

    public function follower()
    {
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follower_id');
    }
     public function saves()
    {
        return $this->hasMany('App\Save');
    }
}
