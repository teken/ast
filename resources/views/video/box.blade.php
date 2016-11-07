<div class="box">
  <div class="wrapper">
    <a href="{{url("/videos/{$video->slug}")}}">
      <div class="title">{{ $video->title }}</div>
      <img class="thumb" src="{{ $video->getVideoThumbnailUrl() }}"/>
      @if(!Auth::guest())
        <div class="actions">
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              @if(Auth::user()->id == $video->user_id || Auth::user()->administrator)
                <li><a href="{{url("/my/videos/{$video->slug}/edit")}}">Edit Video</a></li>
              @endif
              @if(Auth::user()->favourites()->pluck('id')->contains($video->id))
                <li><a href="{{url("/videos/{$video->slug}/unfavourite")}}">Unfavourite</a></li>
              @else
                <li><a href="{{url("/videos/{$video->slug}/favourite")}}">Favourite</a></li>
              @endif
            </ul>
          </div>
        </div>
      @endif
    </a>
  </div>
</div>
