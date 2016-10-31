@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/modules/new')}}">Create Module</a></li>
@endsection

@section('content')
    @include('video.bymodule', ['modules' => $modules])
@endsection
