<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleVideo extends Model
{
    protected $table = 'modulevideos';

    protected $fillable = [
        'module_id', 'video_id'
    ];

    public function module() {
       return $this->belongsTo('App\module', 'module_id');
    }

    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }
}
