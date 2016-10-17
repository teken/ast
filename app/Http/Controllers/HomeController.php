<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::with('videos')->all();
        return view('video.bymodule', [$modules]);
    }
}
