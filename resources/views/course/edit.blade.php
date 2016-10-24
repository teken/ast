@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                  <form action="{{url('/courses')}}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field($method) !!}
                    <input type="hidden" name="id" placeholder="title" value="{{$course->id}}"/>
                    <div class="form-group">
                      <input type="text" name="title" placeholder="title" value="{{$course->title}}"/>
                    </div>
                    <div class="form-group">
                      <textarea name="description" placeholder="Some text...">{{$course->description}}</textarea>
                    </div>
                    <div class="form-group">
                      <select multiple name="moduleslugs[]">
                        @forelse($modules as $module)
                          <option value="{{$module->slug}}">{{$module->title}}</option>
                        @empty
                          <option>Sorry there are no modules that i can find.</option>
                        @endforelse
                      </select>
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
