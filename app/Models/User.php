<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function videos() {
       return $this->hasMany('App\Video');
    }

    public function comments() {
       return $this->hasMany('App\VideoComment');
    }

    public function ratings() {
       return $this->hasMany('App\VideoRating');
    }

    public function favorites() {
       return $this->hasMany('App\UserFavorite');
    }
}
