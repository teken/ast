@extends('layouts.app')

@section('title')Favourites @endsection

@section('content')
  <div class="videos gallery grid">
      @each('video.box', $videos->get(), 'video')
  </div>
@endsection
