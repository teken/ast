<div class="box">
  <div class="wrapper">
    <a href="{{url('/modules/'.$module->slug)}}">
      <div class="title">{{$module->title}}</div>
      @if($module->videos()->count() > 0)
        <img class="thumb" src="{{$module->videos()->first()->getVideoThumbnailUrl()}}" />
      @endif
    </a>
  </div>
</div>
