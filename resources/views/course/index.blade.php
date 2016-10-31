@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/courses/new')}}">Create Course</a></li>
@endsection

@section('content')
    @foreach($courses as $course)
        <div class="course gallery">
          <div class="title"><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></div>
          <div class="modules">
            <ul>
              @foreach($course->modules()->get() as $module)
                  <li><a href="{{url('/modules/'.$module->slug)}}">{{$module->title}}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
    @endforeach
@endsection
