@extends('layouts.app')

@section('content')
    @if(!Auth::guest() and Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/modules/new')}}">Create Module</a></li>
            </ul>
          </div>
        </div>
    @endif
    @foreach($modules as $module)
        <div class="row module">
          <div class="title"><a href="{{url('/modules/'.$module->slug)}}">{{$module->title}}</a></div>
          <div class="videos">
              @each('video.box', $module->videos(), 'video')
          </div>
        </div>
    @endforeach
@endsection
