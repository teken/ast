<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
    return view('video.my', ['videos' => $user->videos()]);
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

  public function store(Request $request) {
    $video;
    if ($request->isMethod('post')) {
      $video = Video::findOrFail($request->input('id'));
    } else if ($request->isMethod('put')) {
      $video = new Video();
    }

    $video->title = $request->input('title');
    $video->description = $request->input('description');
    $video->slug = str_slug($video->title);

    $video->modules()->sync($request->input('moduleids'));

    $video->save();

    return redirect()->action('VideoController@details', ['slug' => $video->slug]);
  }

  public function delete() {

  }
}
