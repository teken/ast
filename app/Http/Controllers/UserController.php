<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use app\User;

class UserController extends Controller
{
      public function index() {
        $users = User::get();
        return view('user.index', $users);
      }

      public function promote($id){
        $user = User::findOrFail($id);
        $user->administrator = true;
        $user ->save();
        return redirect()->action('UserController@index');
      }

      public function demote($id){
        $user = User::findOrFail($id);
        $user->administrator = false;
        $user ->save();
        return redirect()->action('UserController@index');
      }
}
