<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Leafo\ScssPhp\Compiler;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function css() {
      $css;
      $scss = new Compiler();
      $scss->addImportPath(function($path) {
        $basePath = base_path("resources/assets/sass/");
          if (!file_exists($basePath.$path)) return null;
          return $basePath.$path;
      });
      $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
      $css = $scss->compile('@import "app.scss";');
      return response($css)->header('Content-Type', 'text/css');
    }
}
