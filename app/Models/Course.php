<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the courses database table
 */
class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'title', 'description', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * defines the relationship between courses and modules using the mapping table coursemodules
     */
    public function modules() {
       return $this->belongsToMany('App\Module', 'coursemodules');
    }

    /**
     * defines the relationship between courses and users using the mapping table usercourses
     */
    public function users() {
       return $this->belongsToMany('App\User', 'usercourses');
    }
}
