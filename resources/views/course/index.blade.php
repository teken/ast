@extends('layouts.app')

@section('adminactions')
  <li><a href="{{url('/courses/new')}}">Create Course</a></li>
@endsection

@section('content')
    @include('module.bycourse', ['courses' => $courses])
@endsection
