<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the modules database table
 */
class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'title', 'description', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * defines the relationship between modules and videos
     */
    public function videos() {
       return $this->belongsToMany('App\Video', 'modulevideos');
    }

    /**
     * defines the relationship between modules and courses
     */
    public function courses() {
       return $this->belongsToMany('App\Course', 'coursemodules');
    }
}
