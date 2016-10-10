<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoComment extends Model
{
    use SoftDeletes;

    protected $table = 'videocomments';

    protected $fillable = [
        'user_id', 'video_id', 'comment'
    ];

    protected $dates = ['created_at','deleted_at'];

    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }

    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }
}
