@extends('layouts.app')

@section('content')
    @if(Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/courses/new')}}">Create Course</a></li>
            </ul>
          </div>
        </div>
    @endif
    @foreach($courses as $course)
        <div class="row course">
          <div class="title"><a url="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></div>
          <div class="modules"><div>
        </div>
    @endforeach
@endsection
