@extends('layouts.app')

@section('content')
    @if(!Auth::guest() and Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/modules/'.$module->slug.'/edit')}}">Edit Module</a></li>
            </ul>
          </div>
        </div>
    @endif
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
