@forelse ($modules as $module)
  @if (count($module->videos()) > 0)
    <div class="module gallery">
      <div class="title">
        {{ $module->title }}
      </div>
      <div class="videos">
        @each('video.box', $module->videos()->get(), 'video')
      </div>
    </div>
  @endif
@empty
  <div class="module gallery empty">
    <div class="message">
      Sorry we didn't find any videos here, you could try adding some.
    </div>
  </div>
@endforelse
