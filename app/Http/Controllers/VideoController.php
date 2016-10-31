<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Module;
use App\Video;
use Auth;

class VideoController extends Controller
{
  public function index(Request $request)
  {
    $videos = Video::get();
    return view('video.index', ['videos' => $videos]);
  }

  public function user(Request $request) {
    $user = Auth::user();
    $user->load('videos');
    return view('video.my', ['videos' => $user->videos()->get()]);
  }

  public function details(Request $request, $slug)
  {
    $video = Video::where('slug', $slug)->get();
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
    $video->save();

    $video->modules()->sync($request->input('moduleids'));

    return redirect()->action('VideoController@details', ['slug' => $video->slug]);
  }

  public function delete() {

  }

  public function favourites(Request $request) {
    $user = Auth::user();
    $user->load('favourites.video');
    return view('favourites.index', ['videos' => $user->favourites()]);
  }

  public function favourite(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->syncWithoutDetaching($video->id);
    return redirect()->action('FavouriteController@index');
  }

  public function unfavourites(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->favourites()->detach($video->id);
    return redirect()->action('FavouriteController@index');
  }
}
