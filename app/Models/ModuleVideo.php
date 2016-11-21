<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * The data model for the modulevideos database mapping table
 */
class ModuleVideo extends Model
{
    protected $table = 'modulevideos';

    protected $fillable = [
        'module_id', 'video_id'
    ];

    /**
     * defines the relationship between modulevideos and modules
     */
    public function module() {
       return $this->belongsTo('App\module', 'module_id');
    }

    /**
     * defines the relationship between modulevideos and videos
     */
    public function video() {
       return $this->belongsTo('App\Video', 'video_id');
    }
}
