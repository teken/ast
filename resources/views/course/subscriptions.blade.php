@extends('layouts.app')

@section('title')Subscriptions @endsection

@section('content')
  @include('module.bycourse', ['courses' => $courses])
@endsection
