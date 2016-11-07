@forelse ($modules as $module)
  @if (count($module->videos()) > 0)
    <div class="module gallery">
      <div class="title">
        <a href="{{ url("/modules/{$module->slug}") }}">
          {{ $module->title }}
        </a>
      </div>
      <div class="videos boxes">
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
