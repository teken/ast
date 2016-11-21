<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the coursemodules database mapping table
 */
class CourseModules extends Model
{
    protected $table = 'coursemodules';

    protected $fillable = [
        'module_id', 'course_id'
    ];

    /**
     * defines the relatonship between the module and the coursemodule
     */
    public function module() {
       return $this->belongsTo('App\module', 'module_id');
    }

    /**
     * defines the relationship between the course and the coursemodule
     */
    public function course() {
       return $this->belongsTo('App\course', 'course_id');
    }
}
