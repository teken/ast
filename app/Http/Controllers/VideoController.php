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

  public function store(Request $request) {

  }

  public function delete() {

  }
}
