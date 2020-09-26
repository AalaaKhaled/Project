<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;
 
    protected $fillable = [
        'description','published_at','user_id','postimage'
    ];
    public function user(){
        return $this->belongsTo('App\User');
        }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
     public function likes()
    {
        return $this->hasMany('App\Like');
    }
     public function saves()
    {
        return $this->hasMany('App\Save');
    }
    
}
