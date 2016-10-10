<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    protected $table = 'userfavorites';

    protected $fillable = [
        'user_id', 'video_id'
    ];

    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }
}
