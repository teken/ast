@extends('layouts.app')

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
                        @if ($user->administrator && $user->id != Auth::user()->id)
                          <a href="{{url("/users/{$user->id}/demote")}}">User Management</a>
                        @else
                          <a href="{{url("/users/{$user->id}/promote")}}">User Management</a>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
