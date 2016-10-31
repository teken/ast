@extends('layouts.app')

@section('content')
    @if(!Auth::guest() and Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url("/videos/{$video->slug}/edit")}}">Edit Video</a></li>
            </ul>
          </div>
        </div>
    @endif
    <div class="video details">
      <div class="title">{{$video->title}}</div>
      <div class="url">{{$video->url}}</div>
      <div class="description">{{$video->description}}</div>
      <div class="tags">{{$video->tags}}</div>
      <div class="actions">
        @if(!Auth::guest() and Auth::user()->favourites()->pluck('id')->contains($video->id))
          <a class="btn btn-default unfavourite" href="{{url("/videos/{$video->slug}/unfavourite")}}">Unfavourite</a>
        @else
          <a class="btn btn-default favourite" href="{{url("/videos/{$video->slug}/favourite")}}">Favourite</a>
        @endif
      </div>
    </div>
@endsection
