<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	//use SoftDeletes;

    protected $fillable = [
        'comment','published_at','user_id','post_id'
    ];
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
