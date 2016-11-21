<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The data model for the videocomments database mapping table
 */
class VideoComment extends Model
{
    use SoftDeletes;

    protected $table = 'videocomments';

    protected $fillable = [
        'user_id', 'video_id', 'comment'
    ];

    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * defines the relatonship between the videocomments and the videos on the foreign key video_id
     */
    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }

    /**
     * defines the relatonship between the videocomments and the users on the foreign key user_id
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }
}
