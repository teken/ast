<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'user_id', 'url', 'title', 'description', 'tags', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    public function modules() {
       return $this->belongsToMany('App\Module', 'modulevideos');
    }

    public function comments() {
       return $this->hasMany('App\VideoComment');
    }

    public function ratings() {
       return $this->hasMany('App\VideoRating');
    }

    public function getVideoHost(){
      $url = parse_url($this->url, PHP_URL_HOST);
      $url = str_replace('www.','', $url);
      $url = explode('.', $url)[0];
      return $url;
    }

    public function getVideoId(){
      switch($this->getVideoHost()){
        case 'youtube':
          parse_str(parse_url($url, PHP_URL_QUERY), $query);
          return $query['v'];
        break;
        case 'vimeo':
          $path = parse_url($url, PHP_URL_QUERY);
          $path = str_replace('/', '', $path);
          return $path;
        break;
      }
    }
}
