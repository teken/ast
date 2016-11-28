@extends('layouts.app')

@section('title'){{$module->title}}@endsection

@section('adminactions')
  <li><a href="{{url("/modules/{$module->slug}/edit")}}">Edit Module</a></li>
  <li><a href="{{url("/modules/{$module->slug}/delete")}}">Delete Module</a></li>
@endsection

@section('searchscope')module:{{$module->slug}}@endsection

@section('searchtext'){{$module->title}}@endsection

@section('content')
    <div class="module details">
      <div class="title">{{$module->title}}</div>
      <div class="description">{{$module->description}}</div>

      <div class="courses">
        <div class="sub title">Courses</div>
        <ul>
            @foreach($module->courses()->get() as $course)
                <li><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></li>
            @endforeach
        </ul>
      </div>
      <div class="sub title">Videos</div>
      <div class="videos gallery">
        <div class="videos boxes">
          @each('video.box', $module->videos()->get(), 'video')
        </div>
      </div>
    </div>
@endsection
