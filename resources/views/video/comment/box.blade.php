<div class="comment">
  <div class="name">{{$comment->user()->first()->name()}}</div>
  <div class="text">{{$comment->comment}}</div>
  <div class="actions pull-right">
    <div class="btn-group">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="glyphicon glyphicon-cog"></i>
      </button>
      <ul class="dropdown-menu">
        @if(!Auth::guest() and Auth::user()->administrator)
          <li><a href="{{url("/comments/{$comment->id}/delete")}}">Delete Comment</a></li>
        @endif
      </ul>
    </div>
  </div>
</div>
