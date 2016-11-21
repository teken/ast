<?php

namespace App;

use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * The data model for the videos database table
 */
class Video extends Model
{
    use SoftDeletes, Eloquence;

    protected $table = 'videos';

    protected $searchableColumns = ['title', 'description', 'tags'];

    protected $fillable = [
        'user_id', 'url', 'title', 'description', 'tags', 'slug'
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * defines the relationship between videos and users on the foreign key user_id
     */
    public function user() {
       return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * defines the relationship between videos and modules using the mapping table modulevideos
     */
    public function modules() {
       return $this->belongsToMany('App\Module', 'modulevideos');
    }

    /**
     * defines the relationship between videos and videocommnets
     */
    public function comments() {
       return $this->hasMany('App\VideoComment');
    }

    /**
     * defines the relationship between videos and videoratings
     */
    public function ratings() {
       return $this->hasMany('App\VideoRating');
    }

    /**
     * returns only good ratings
     */
    public function goodRatings() {
       return $this->ratings()->where('rating', true);
    }

    /**
     * returns only bad ratings
     */
    public function badRatings() {
       return $this->ratings()->where('rating', false);
    }

    /**
     * defines the relationship between videos and users using the mapping table userfavourites
     */
    public function favourites() {
      return $this->belongsToMany('App\User', 'userfavorites');
    }

    /**
     * examines the video url and return the host
     */
    public function getVideoHost(){
      $url = parse_url($this->url, PHP_URL_HOST);
      $url = str_replace('www.','', $url);
      $url = explode('.', $url)[0];
      return $url;
    }

    /**
     * examines the video url and returns the id
     */
    public function getVideoId(){
      switch($this->getVideoHost()){
        case 'youtube':
          parse_str(parse_url($this->url, PHP_URL_QUERY), $query);
          return $query['v'];
        break;
        case 'youtu':
          $path = parse_url($this->url, PHP_URL_PATH);
          $path = str_replace('/', '', $path);
          return $path;
        break;
        case 'vimeo':
          $path = parse_url($this->url, PHP_URL_PATH);
          $path = str_replace('/', '', $path);
          return $path;
        break;
      }
    }

    /**
     * examines the video url and returns the url to the thumbnail for the video
     */
    public function getVideoThumbnailUrl(){
      switch($this->getVideoHost()){
        case 'youtube':
        case 'youtu':
          return "https://i1.ytimg.com/vi/".$this->getVideoId()."/hqdefault.jpg";
        break;
        case 'vimeo':
          $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$this->getVideoId().".php"));
          return $hash[0]['thumbnail_large'];
        break;
        default:
          return url('/defaultthumb');
        break;
      }
    }
}
