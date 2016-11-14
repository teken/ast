@extends('layouts.app')

@section('title')My Videos @endsection

@section('content')
  <div class="videos gallery grid">
    @each('video.box', $videos, 'video')
  </div>
@endsection
