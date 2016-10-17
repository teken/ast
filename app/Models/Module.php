<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'title', 'description', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function videos() {
       return $this->belongsToMany('App\Video', 'modulevideos');
    }

    public function courses() {
       return $this->belongsToMany('App\Course', 'coursemodules');
    }
}
