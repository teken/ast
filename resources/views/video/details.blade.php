@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url("/videos/{$video->slug}/edit")}}">Edit Video</a></li>
@endsection

@section('content')
  <div class="video details">
    <div class="player wrapper">
      <div data-type="{{$video->getVideoHost()}}" data-video-id="{{$video->getVideoId()}}"></div>
    </div>
    <div class="details">
      <div class="title">{{$video->title}}</div>
      <div class="url">{{$video->url}}</div>
      <div class="description">{{$video->description}}</div>
      <div class="tags">{{$video->tags}}</div>
      <div class="actions">
        @if(!Auth::guest())
          @if(Auth::user()->favourites()->pluck('id')->contains($video->id))
            <a class="btn btn-default unfavourite" href="{{url("/videos/{$video->slug}/unfavourite")}}">Unfavourite</a>
          @else
            <a class="btn btn-default favourite" href="{{url("/videos/{$video->slug}/favourite")}}">Favourite</a>
          @endif
        @endif
      </div>
    </div>
    <div class="comments">
      <div class="new">
        @if(!Auth::guest())
          <form action="{{url("/videos/{$video->slug}/comment")}}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <div class="form-group">
              <textarea type="text" name="comment" placeholder="Comment..."></textarea>
            </div>
            <div class="form-group pull-right">
              <input class="btn btn-default" type="submit" value="Submit Comment"/>
            </div>
          </form>
        @else
          <textarea type="text" name="comment" placeholder="Please sign to in to comment." disabled></textarea>
        @endif
      </div>
      @each('video.comment.box', $video->comments(), 'comment')
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdn.plyr.io/2.0.9/plyr.js"></script>
  <script>plyr.setup();</script>
@endsection

@section('styles')
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.9/plyr.css">
@endsection
