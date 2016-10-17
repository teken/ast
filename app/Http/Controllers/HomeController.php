<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;

class HomeController extends Controller
{
    public function index()
    {
        $modules = Module::with('videos')->get();
        return view('video.bymodule', ['modules' => $modules]);
    }
}
