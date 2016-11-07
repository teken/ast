@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/modules/'.$module->slug.'/edit')}}">Edit Module</a></li>
@endsection

@section('content')
    <div class="module details">
      <div class="title">{{$module->title}}</div>
      <div class="description">{{$module->description}}</div>

      <div class="courses">
        <div class="title">Courses Module Is In</div>
        <ul>
            @foreach($module->courses()->get() as $course)
                <li><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></li>
            @endforeach
        </ul>
      </div>
      <div class="videos gallery">
        <div class="title">Videos in Module</div>
        @each('video.box', $module->videos()->get(), 'video')
      </div>
    </div>
@endsection
