@extends('layouts.app')

@section('title'){{$video->title}}@endsection

@section('adminactions')
  <li><a href="{{url("/videos/{$video->slug}/edit")}}">Edit Video</a></li>
  <li><a href="{{url("/videos/{$video->slug}/delete")}}">Delete Video</a></li>
@endsection

@section('content')
  <div class="video details">
    <div class="player wrapper">
      <div data-type="{{$video->getVideoHost()}}" data-video-id="{{$video->getVideoId()}}"></div>
    </div>
    <div class="details">
      <div class="title">
        <a href="{{$video->url}}" target="_blank">{{$video->title}}</a>
      </div>
      {{--<div class="url">{{$video->url}}</div>--}}
      <div class="col-sm-6">
        <div class="description">{{$video->description}}</div>
        <div class="tags">{{$video->tags}}</div>
      </div>
      <div class="col-sm-6">
        <div class="actions pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->favourites()->pluck('video_id')->contains($video->id))
              <a class="btn btn-default unfavourite" href="{{url("/videos/{$video->slug}/unfavourite")}}">Unfavourite</a>
            @else
              <a class="btn btn-default favourite" href="{{url("/videos/{$video->slug}/favourite")}}">Favourite</a>
            @endif
          @endif
        </div>
        <div class="rating pull-right">
          {{"Good: ".$video->goodRatings()->count()." Bad: ".$video->badRatings()->count()}}
        </div>
      </div>
    </div>
    <div class="comments">
      <div class="new clearfix">
        @if(!Auth::guest())
          <form action="{{url("/videos/{$video->slug}/comment")}}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <div class="form-group">
              <textarea type="text" name="comment" placeholder="Comment..." class="form-control"></textarea>
            </div>
            <div class="form-group pull-right">
              <input class="btn btn-default" type="submit" value="Submit Comment"/>
            </div>
          </form>
        @else
          <textarea type="text" name="comment" placeholder="Please sign to in to comment." class="form-control" disabled></textarea>
        @endif
      </div>
      @each('video.comment.box', $video->comments()->orderBy('created_at', 'desc')->take(100)->get(), 'comment')
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
