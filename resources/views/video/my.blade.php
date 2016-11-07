@extends('layouts.app')

@section('content')
  <div class="videos gallery">
    @each('video.box', $videos, 'video')
  </div>
@endsection
