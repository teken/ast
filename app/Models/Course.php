<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'title', 'description', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function modules() {
       return $this->belongsToMany('App\Modules', 'coursemodules');
    }

    public function users() {
       return $this->belongsToMany('App\User', 'usercourses');
    }

    //TODO figure out the cals and things
    /*public function topVideos(){
      return $this->hasManyThrough('App\Video', 'App\Module', 'module_id', 'video_id', 'id' )->sortByDesc('rating');
    }*/
}
