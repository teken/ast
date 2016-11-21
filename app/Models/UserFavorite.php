<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the userfavourites database mapping table
 */
class UserFavorite extends Model
{
    protected $table = 'userfavorites';

    protected $fillable = [
        'user_id', 'video_id'
    ];

    protected $dates = [
        'created_at'
    ];

    /**
     * defines the relatonship between the userfavourites and the users
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * defines the relatonship between the userfavourites and the videos
     */
    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }
}
