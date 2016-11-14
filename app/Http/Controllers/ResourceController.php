<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Leafo\ScssPhp\Compiler;

class ResourceController extends Controller
{
  public function css() {
    $css;
    $scss = new Compiler();
    $scss->addImportPath(function($path) {
        $basePath = base_path("resources/assets/sass/");
        if (file_exists($basePath.$path)) return $basePath.$path;
        if (file_exists($path)) return $path;
        return null;
    });
    $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
    $css = $scss->compile('@import "app.scss";');
    return response($css, 200)->withHeaders(['Content-Type'=> 'text/css', 'Cache-control'=> 'no-cache']); //	max-age = seconds
  }

  public function defaultthumb()
  {
    return response()->file(resource_path('assets/imgs/video_icon.png')); //	max-age = seconds
  }
}
