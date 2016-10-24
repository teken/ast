@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Administration Area</div>

                <div class="panel-body">
                  Welcome to {{config('app.name')}} administration area!
                </div>
            </div>
        </div>
    </div>
@endsection
