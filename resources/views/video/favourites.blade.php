@extends('layouts.app')

@section('content')
  <div class="videos">
    @each('video.box', $videos->get(), 'video')
  </div>
@endsection
