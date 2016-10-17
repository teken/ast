<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseModules extends Model
{
    protected $table = 'coursemodules';

    protected $fillable = [
        'module_id', 'course_id'
    ];

    public function module() {
       return $this->belongsTo('App\module', 'module_id');
    }

    public function course() {
       return $this->belongsTo('App\course', 'course_id');
    }
}
