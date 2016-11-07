@extends('layouts.app')

@section('content')
  @include('module.bycourse', ['courses' => $courses])
@endsection
