@extends('layouts.app')

@section('content')
  <div class="videos gallery">
    @each('video.box', $videos->get(), 'video')
  </div>
@endsection
