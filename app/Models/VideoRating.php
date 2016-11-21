<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the videoratings database mapping table
 */
class VideoRating extends Model
{
    protected $table = 'videoratings';

    protected $fillable = [
        'user_id', 'video_id', 'rating'
    ];

    public $timestamps = false;

    /**
     * defines the relatonship between the videoratings and the videos on the foreign key video_id
     */
    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }

    /**
     * defines the relatonship between the videoratings and the users on the foreign key user_id
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }
}
