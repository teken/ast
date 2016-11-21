<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

/**
 * Controller that contains actions relating to the administration
 */
class AdministratorController extends Controller
{
    /**
     * Constructor for AdministratorController
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * returns the admin index view
     */
    public function index(Request $request) {

      return view('admin.index');
    }
}
