@extends('layouts.app')

@section('content')
    @if(Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/courses/'.$course->slug.'/new')}}">Edit Course</a></li>
            </ul>
          </div>
        </div>
    @endif
    <div class="course details">
      <div class="title">{{$course->title}}</div>
      <div class="description">{{$course->description}}</div>
      <div class="actions">
        <a class="btn btn-default" href="{{url('/courses/'.$course->slug.'/subscribe')}}">Subscribe</a>
        <a class="btn btn-default" href="{{url('/courses/'.$course->slug.'/unsubscribe')}}">Unsubscribe</a>
      </div>

      @include('video.bymodule', ['modules' => $course->modules()])
    </div>
@endsection
