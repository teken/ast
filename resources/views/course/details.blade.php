@extends('layouts.app')

@section('content')
    @if(!Auth::guest() and Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/courses/'.$course->slug.'/edit')}}">Edit Course</a></li>
            </ul>
          </div>
        </div>
    @endif
    <div class="course details">
      <div class="title">{{$course->title}}</div>
      <div class="description">{{$course->description}}</div>
      <div class="actions">
        @if(Auth::user()->favorites()->where('id', $course->id)->count < 0)
          <a class="btn btn-default unsubscribe" href="{{url("/courses/{$course->slug}/unsubscribe")}}">Unsubscribe</a>
        @else
          <a class="btn btn-default subscribe" href="{{url("/courses/{$course->slug}/subscribe")}}">Subscribe</a>
        @endif
      </div>
      @include('video.bymodule', ['modules' => $course->modules()])
    </div>
@endsection
