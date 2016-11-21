<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use app\User;

/**
 * Controller that contains actions relating to the users
 */
class UserController extends Controller
{
      /**
       * returns all users in the view, user index
       */
      public function index() {
        $users = User::get();
        return view('user.index', ['users'=>$users]);
      }

      /**
       * Promotes the given user to administrator and then redirect to the index action
       */
      public function promote($id){
        $user = User::findOrFail($id);
        $user->administrator = true;
        $user ->save();
        return redirect()->action('UserController@index');
      }

      /**
       * Demotes the given user from administrator and then redirect to the index action 
       */
      public function demote($id){
        $user = User::findOrFail($id);
        $user->administrator = false;
        $user ->save();
        return redirect()->action('UserController@index');
      }
}
