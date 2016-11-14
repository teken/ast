<div class="box">
  <div class="wrapper">
    <a href="{{url('/modules/'.$module->slug)}}">
      <div class="title">{{$module->title}}</div>
      @if($module->videos()->count() > 0)
        <img class="thumb" src="{{$module->videos()->first()->getVideoThumbnailUrl()}}" />
      @else
        <img class="thumb" src="{{url("/defaultthumb")}}" />
      @endif
    </a>
  </div>
</div>
