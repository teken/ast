<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoRating extends Model
{
    protected $table = 'videoratings';

    protected $fillable = [
        'user_id', 'video_id', 'rating'
    ];

    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }

    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }
}
