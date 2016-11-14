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
use Auth;

class VideoController extends Controller
{
  public function home()
  {
    $videos = Video::orderBy('created_at', 'desc')->get();
    return view('video.index', ['videos' => $videos]);
  }

  public function user(Request $request) {
    $user = Auth::user();
    $user->load('videos');
    return view('video.my', ['videos' => $user->videos()->get()]);
  }

  public function details(Request $request, $slug)
  {
    $video = Video::with('comments')->where('slug', $slug)->firstOrFail();
    return view('video.details', ['video' => $video]);
  }

  public function new() {
    $video = new Video();
    $modules = Module::get();
    return view('video.edit', ['video' => $video, 'modules' => $modules, 'method' => 'PUT']);
  }

  public function edit($slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $modules = Module::get();
    return view('video.edit', ['video' => $video, 'modules' => $modules, 'method' => 'POST']);
  }

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

  public function delete($slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    if ($user->id == $video->user_id || $user->administrator) $video->delete();
    return redirect()->back();
  }

  public function favourites(Request $request) {
    $user = Auth::user();
    $user->load('favourites');
    dump($user->favourites()->get());
    return view('video.favourites', ['videos' => $user->favourites()->get()]);
  }

  public function favourite(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->syncWithoutDetaching([$video->id]);
    return redirect()->back();
  }

  public function unfavourite(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->detach($video->id);
    return redirect()->back();
  }

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

  public function deleteComment(Request $request, $id) {
    $comment = VideoComment::findorFail($id);
    $user = Auth::user();
    if ($user->id == $comment->user_id || $user->administrator) $comment->delete();
    return redirect()->back();
  }

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
}
