@extends('layouts.app')

@section('title'){{$course->title}}@endsection

@section('adminactions')
  <li><a href="{{url("/courses/{$course->slug}/edit")}}">Edit Course</a></li>
  <li><a href="{{url("/courses/{$course->slug}/delete")}}">Delete Course</a></li>
@endsection

@section('searchscope')course:{{$course->slug}}@endsection

@section('content')
    <div class="course details">
      <div class="title">{{$course->title}}</div>
      <div class="description">{{$course->description}}</div>
      <div class="actions">
        @if(!Auth::guest())
          @if(Auth::user()->courses()->pluck('id')->contains($course->id))
            <a class="btn btn-default unsubscribe" href="{{url("/courses/{$course->slug}/unsubscribe")}}">Unsubscribe</a>
          @else
            <a class="btn btn-default subscribe" href="{{url("/courses/{$course->slug}/subscribe")}}">Subscribe</a>
          @endif
        @endif
      </div>
      <div class="sub title">Modules in Course</div>
      @include('video.bymodule', ['modules' => $course->modules()->get()])
    </div>
@endsection
