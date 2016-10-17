<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::with('videos');
        return view('video.bymodule', [$modules]);
    }
}
