@extends('layouts.app')

@section('content')
  <div class="videos gallery grid">
      @each('video.box', $videos, 'video')
  </div>
@endsection
