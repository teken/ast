<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Video;

class FavouriteController extends Controller
{
  public function index(Request $request) {
    $user = Auth::user();
    $user->load('favourites.video');
    return view('favourites.index', ['videos' => $user->favourites()]);
  }

  public function store(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();

    $user->favourites()->syncWithoutDetaching($video->id);

    return redirect()->action('FavouriteController@index');
  }

  public function delete(Request $request, $slug) {
    $video = Video::where('slug', $slug)->firstOrFail();
    $user = Auth::user();

    $user->favourites()->detach($video->id);

    return redirect()->action('FavouriteController@index');
  }
}
