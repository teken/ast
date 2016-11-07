@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/courses/new')}}">Create Course</a></li>
@endsection

@section('content')
    @foreach($courses as $course)
        <div class="course gallery">
          <div class="title"><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></div>
          <div class="modules boxes">
            @each('module.box', $course->modules()->get(), 'module')
          </div>
        </div>
    @endforeach
@endsection
