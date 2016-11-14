<div class="box">
  <div class="wrapper">
    <a href="{{url('/modules/'.$module->slug)}}">
      <div class="title">{{$module->title}}</div>
      <img class="thumb" @if($module->videos()->count() > 0)src="{{$module->videos()->first()->getVideoThumbnailUrl()}}"@endif />
    </a>
  </div>
</div>
