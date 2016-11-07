@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/courses/new')}}">Create Course</a></li>
@endsection

@section('content')
    @foreach($courses as $course)
        <div class="course gallery">
          <div class="title"><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></div>
          <div class="modules boxes">
            <ul>
              @foreach($course->modules()->get() as $module)
                  <li>
                    <div class="wrapper">
                      <a href="{{url('/modules/'.$module->slug)}}">{{$module->title}}
                      </div>
                    </a>
                  </li>
              @endforeach
            </ul>
          </div>
        </div>
    @endforeach
@endsection
