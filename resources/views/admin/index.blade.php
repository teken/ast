@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administration Area</div>

                <div class="panel-body">
                  Welcome to {{config('app.name')}} administration area!
                </div>

                <ul class="list-group">
                  <li class="list-group-item">
                    <a href="{{url('/users')}}">User Management</a>
                  </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
