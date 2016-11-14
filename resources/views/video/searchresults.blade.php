@extends('layouts.app')

@section('content')
  @if($videos->count() > 0)
    <div class="videos gallery">
      @each('video.box', $videos, 'video')
    </div>
  @else
    <div class="videos none">
      <h1>Im sorry but i can't find any videos :(</h1>
    </div>
  @endif
@endsection
