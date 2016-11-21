<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * The data model for the users database table
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';


    protected $fillable = [
        'firstname','lastname', 'email', 'password', 'administrator'
    ];

    protected $dates = ['created_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * defines the relationship between users and courses using the mapping table usercourses
     */
    public function courses() {
       return $this->belongsToMany('App\Course', 'usercourses');
    }

    /**
     * defines the relationship between users and videos
     */
    public function videos() {
       return $this->hasMany('App\Video');
    }

    /**
     * defines the relationship between users and videocomments
     */
    public function comments() {
       return $this->hasMany('App\VideoComment');
    }

    /**
     * defines the relationship between users and videoratings
     */
    public function ratings() {
       return $this->hasMany('App\VideoRating');
    }

    /**
     * defines the relationship between users and videos using the mapping table userfavourites
     */
    public function favourites() {
       return $this->belongsToMany('App\Video', 'userfavorites');
    }

    /**
     * returns the full name of the user
     */
    public function name() {
      return $this->firstname." ".$this->lastname;
    }
}
