<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the usercourses database mapping table
 */
class UserCourse extends Model
{
    protected $table = 'usercourses';

    protected $fillable = [
        'user_id', 'course_id'
    ];

    /**
     * defines the relatonship between the usercourses and the users on the foreign key user_id
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * defines the relatonship between the usercourses and the courses on the foreign key course_id
     */
    public function course() {
       return $this->belongsTo('App\Course', 'course_id');
    }
}
