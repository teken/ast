@extends('layouts.app')

@section('title')User Management @endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Management</div>

                <table class="table">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                  </tr>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{$user->name()}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        @if ($user->id != Auth::user()->id)
                          @if ($user->administrator)
                            <a href="{{url("/users/{$user->id}/demote")}}">Demote</a>
                          @else
                            <a href="{{url("/users/{$user->id}/promote")}}">Promote</a>
                          @endif
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
