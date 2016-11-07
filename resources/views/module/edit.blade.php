@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                  <form action="{{url('/modules')}}" method="POST">
                    {!! csrf_field() !!}
                    {!! method_field($method) !!}
                    <input type="hidden" name="id" placeholder="title" value="{{$module->id}}"/>
                    <div class="form-group">
                      <input class="form-control" type="text" name="title" placeholder="title" value="{{$module->title}}"/>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="description" placeholder="Some text...">{{$module->description}}</textarea>
                    </div>
                    <div class="form-control" class="form-group">
                      <select multiple name="courseids[]">
                        @forelse($courses as $course)
                          <option value="{{$course->id}}">{{$course->title}}</option>
                        @empty
                          <option>Sorry there are no courses that i can find.</option>
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
