<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\CourseModule;
use App\Module;
use App\ModuleVideo;
use App\Video;
use App\VideoComment;
use App\VideoRating;
use Auth;

/**
 * Controller that contains actions relating to the videos
 */
class VideoController extends Controller
{
  /**
  * returns the video index view with all videos order by decending order using the 'created_at' date.
  */
  public function home()
  {
    $subscriptions = null;
    if (!Auth::guest()) {
      $user = Auth::user();
      $user->load('courses.modules.videos');
      dump($user->courses()->get());
      dump($user->courses()->get()->pluck('modules')->flatten());
      dump($user->courses()->get()->pluck('modules')->flatten()->pluck('videos')->flatten());
      $subscriptions = $user->courses()->get()->pluck('modules')->pluck('videos')->sortByDesc('created_at', function($col, $key){return $col->created_at;})->forPage(1,9)->get();
    }
    $videos = Video::orderBy('created_at', 'desc')->limit(9)->get();
    return view('video.index', ['videos' => $videos, 'subscriptions' => $subscriptions]);
  }

  /**
  * returns the video index view with all videos order by decending order using the 'created_at' date.
  * Also eager loads users videos
  */
  public function user(Request $request) {
    $user = Auth::user();
    $user->load('videos');
    return view('video.my', ['videos' => $user->videos()->get()]);
  }

  /**
  * returns the video details view for a specific video.
  */
  public function details(Request $request, $slug)
  {
    $video = Video::with('comments')->where('slug', $slug)->firstOrFail();
    return view('video.details', ['video' => $video]);
  }

  /**
  * returns the video edit view with a blank video.
  */
  public function new() {
    $video = new Video();
    $modules = Module::get();
    return view('video.edit', ['video' => $video, 'modules' => $modules, 'method' => 'PUT']);
  }

  /**
  * returns the video edit view with a specific video.
  */
  public function edit($slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $modules = Module::get();
    return view('video.edit', ['video' => $video, 'modules' => $modules, 'method' => 'POST']);
  }

  /**
  * saves either new or edit video and redirects to the index action
  */
  public function store(Request $request, $slug = null) {
    $video;
    if ($request->isMethod('post')) {
      $video = Video::where('slug', $slug)->firstOrFail();
    } else if ($request->isMethod('put')) {
      $video = new Video();
    }

    $video->title = $request->input('title');
    $video->url = $request->input('url');
    $video->description = $request->input('description');
    $video->tags = $request->input('tags');
    $video->slug = str_slug($video->title);
    $video->user_id = Auth::user()->id;

    if (Video::where('slug', $video->slug)->count() > 0){
      $nameParts = explode('_', $video->slug);
      $end = array_pop($nameParts);
      if (is_int($end)){
        $value = intval($end);
        array_push($nameParts, $value++);
      } else {
        array_push($nameParts, $end, '2');
      }
      $video->slug = implode('_', $nameParts);
    }

    $video->save();

    $video->modules()->sync($request->input('moduleids'));

    return redirect()->action('VideoController@details', ['slug' => $video->slug]);
  }

  /**
  * Deletes a specific video and redirects to the index action
  */
  public function delete($slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    if ($user->id == $video->user_id || $user->administrator) $video->delete();
    return redirect()->action('VideoController@user');
  }

  /**
   * returns the currents users favourites on the video favourites view.
   */
  public function favourites(Request $request) {
    $user = Auth::user();
    $user->load('favourites');
    return view('video.favourites', ['videos' => $user->favourites()->get()]);
  }

  /**
   * Favourites a video for the current user, then redircts back to the previous URl
   */
  public function favourite(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->syncWithoutDetaching([$video->id]);
    return redirect()->back();
  }

  /**
   * Unfavourites a video for the current user, then redircts back to the previous URl
   */
  public function unfavourite(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->detach($video->id);
    return redirect()->back();
  }

  /**
   * Creates a new video comment for a specified video
   */
  public function comment(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $comment = new VideoComment();
    $comment->comment = $request->input('comment');
    $comment->user_id = $user->id;
    $comment->video_id = $video->id;
    $comment->save();
    return redirect()->back();
  }

  /**
   * Deletes a video comment for a specified video
   */
  public function deleteComment(Request $request, $id) {
    $comment = VideoComment::findorFail($id);
    $user = Auth::user();
    if ($user->administrator) $comment->delete();
    return redirect()->back();
  }

  /**
   * Searches for videos using a specific term, and in a specific scope of scope if scope is provided.
   */
  public function search(Request $request, $term) {
    $results = Video::search($term);
    if($request->has('scope'))
    {
      $scope = $request->input('scope');
      $parts = explode(':', $scope);
      switch ($parts[0]) {
        case 'course':
          $course = Course::where('slug', $parts[1])->firstOrFail();
          $courseLinks = CourseModule::where('course_id', $course_id)->pluck('module_id');
          $moduleLinks = ModuleVideo::whereIn('module_id',$courseLinks)->pluck('video_id');
          $results = $results->whereIn('id', $moduleLinks);
          break;
        case 'module':
          $module = Module::where('slug', $parts[1])->firstOrFail();
          $moduleLinks = ModuleVideo::where('module_id',$module->id)->pluck('video_id');
          $results = $results->whereIn('id', $moduleLinks);
          break;
      }
    }
    return view('video.searchresults', ['videos' => $results->get()]);
  }


  /**
   * Rates a specific video as good.
   */
  public function rateGood(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $this->rate($video->id, $user->id, true);
    return redirect()->back();
  }

  /**
   * Rates a specific video as bad.
   */
  public function rateBad(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $this->rate($video->id, $user->id, false);
    return redirect()->back();
  }

  /**
   * Rates a specific video as value provided. Powers the rateGood and rateBad functions.
   */
  private function rate($video_id, $user_id, $rate)
  {
    $rating = VideoRating::where([['user_id','=',$user_id],['video_id', '=', $video_id]])->first();
    if ($rating == null) $rating = new VideoRating();
    $rating->video_id = $video_id;
    $rating->user_id = $user_id;
    $rating->rating = $rate;
    $rating->save();
  }
}
