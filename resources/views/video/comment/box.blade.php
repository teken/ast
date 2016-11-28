<div class="comment">
  <div class="name">{{$comment->user()->first()->name()}}</div>
  <div class="text">{{$comment->comment}}</div>
  <div class="actions pull-right">
    @if(!Auth::guest() and Auth::user()->administrator)
    <div class="btn-group dropup">
      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="glyphicon glyphicon-cog"></i>
      </button>
      <ul class="dropdown-menu">
          <li><a href="{{url("/comments/{$comment->id}/delete")}}">Delete Comment</a></li>
      </ul>
    </div>
    @endif
  </div>
</div>
