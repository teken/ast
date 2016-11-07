@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                  <form action="{{url("/my/videos/{$video->slug}")}}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field($method) !!}
                    <div class="form-group">
                      <label for="url">URL</label>
                      <input class="form-control" type="text" name="url" placeholder="url" value="{{$video->url}}"/>
                    </div>
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input class="form-control" type="text" name="title" placeholder="title" value="{{$video->title}}"/>
                    </div>
                    <div class="form-group">
                      <label for="description">Descritpion</label>
                      <textarea class="form-control" name="description" placeholder="Some text...">{{$video->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <select class="form-control" multiple name="moduleids[]">
                        @forelse($modules as $module)
                          <option value="{{$module->id}}">{{$module->title}}</option>
                        @empty
                          <option>Sorry there are no modules that i can find.</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tags">Tags <small>Comma Separated List</small></label>
                      <textarea class="form-control" name="tags" placeholder="Some text...">{{$video->tags}}</textarea>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Save" class="pull-right btn btn-primary" />
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
