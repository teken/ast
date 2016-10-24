<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ModuleController extends Controller
{
  public function index(Request $request)
  {
    $modules = Module::get();
    return view('module.index', ['modules' => $modules])
  }

  public function details(Request $request, $slug)
  {
    $module = Module::where('slug', $slug)->get();
    return view('module.details', ['module' => $module])
  }

  public function store() {

  }

  public function delete() {

  }
}
