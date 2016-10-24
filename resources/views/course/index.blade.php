@extends('layouts.app')

@section('content')
    @if(Auth::user()->administrator)
        <div class="row admin toolbar">
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </div>
        </div>
    @endif
    @foreach($courses as $course)
        <div class="row course">
          <div class="title">{{$course->title}}</div>
        </div>
    @endforeach
@endsection
