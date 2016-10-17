@extends('layouts.app')

@section('content')
  @forelse ($modules as $module)
    @if (count($module->videos()) > 0)
      <div class="row">
        <div class="title">
          {{ $module->title }}
        </div>
        <div class="videos">
          @each('video.box', $module->videos(), 'video')
        </div>
      </div>
    @endif
  @empty
    <div class="row">
      <div class="message">
        Sorry we didn't find any videos here, you could try adding some.
      </div>
    </div>
  @endforelse
@endsection
