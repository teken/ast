@extends('layouts.app')

@section('content')
    @foreach($courses as $course)
        <div class="row course">
          <div class="title"><a href="{{url('/courses/'.$course->slug)}}">{{$course->title}}</a></div>
          <div class="modules">
            @include('video.bymodule', ['module'=>$course->modules()])
          </div>
        </div>
    @endforeach
@endsection
