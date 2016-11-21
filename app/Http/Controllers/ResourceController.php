<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Leafo\ScssPhp\Compiler;

/**
 * Controller that contains actions relating to the site resources
 */
class ResourceController extends Controller
{
  /**
   * Compiles and returns the CSS from SCSS files located in 'resources/assets/sass/' using the app.scss as the main file
   */
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
}
