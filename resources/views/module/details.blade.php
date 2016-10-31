@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/modules/'.$module->slug.'/edit')}}">Edit Module</a></li>
@endsection

@section('content')
    <div class="module details">
      <div class="title">{{$module->title}}</div>
      <div class="description">{{$module->description}}</div>

      <div class="courses">
        <ul>
            @foreach($module->courses() as $course)
                <li><a href="{{url('/courses/'.$course->slug)}}">$course->title</a></li>
            @endforeach
        </ul>
      </div>
      <div class="videos">
        @each('video.box', $module->videos(), 'video')
      </div>
    </div>
@endsection
