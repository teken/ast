@extends('layouts.app')

@section('content')
  <div class="videos">
    @each('video.box', $module->videos(), 'video')
  </div>
@endsection
