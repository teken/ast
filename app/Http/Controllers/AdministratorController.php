<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function index(Requesr $request) {

      return view('admin.index');
    }
}
