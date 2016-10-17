<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'user_id', 'url', 'title', 'description', 'tags', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    public function modules() {
       return $this->belongsToMany('App\Module', 'modulevideos');
    }

    public function comments() {
       return $this->hasMany('App\VideoComment');
    }

    public function ratings() {
       return $this->hasMany('App\VideoRating');
    }
}
