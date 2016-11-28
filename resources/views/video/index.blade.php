@extends('layouts.app')

@section('content')
  <div class="home">
    @if (!Auth::guest())
      <div class="title">Subscriptions</div>
        <div class="videos gallery grid">
          @each('video.box', $subscriptions, 'video')
        </div>
    @endif
    <div class="title">New Videos</div>
    <div class="videos gallery grid">
      @each('video.box', $videos, 'video')
    </div>
  </div>
@endsection
