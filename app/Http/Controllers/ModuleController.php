<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Module;
use Auth;

class ModuleController extends Controller
{
  public function index(Request $request)
  {
    $modules = Module::get();
    return view('module.index', ['modules' => $modules]);
  }

  public function details(Request $request, $slug)
  {
    $module = Module::with('videos')->where('slug', $slug)->firstOrFail();
    return view('module.details', ['module' => $module]);
  }

  public function new() {
    $module = new Module();
    $courses = Course::get();
    return view('module.edit', ['module' => $module, 'courses' => $courses, 'method' => 'PUT']);
  }

  public function edit($slug) {
    $module = Module::where('slug', $slug)->firstOrFail();
    $courses = Course::get();
    return view('module.edit', ['module' => $module, 'courses' => $courses, 'method' => 'POST']);
  }

  public function store(Request $request) {
    $module;
    if ($request->isMethod('post')) {
      $module = Module::findOrFail($request->input('id'));
    } else if ($request->isMethod('put')) {
      $module = new Module();
    }

    $module->title = $request->input('title');
    $module->description = $request->input('description');
    $module->slug = str_slug($module->title);

    $courseids = $request->input('courseids');
    if($courseids != null) $module->courses()->sync($courseids);

    $module->save();

    return redirect()->action('ModuleController@index');
  }

  public function delete(Request $request, $slug) {
    Module::where('slug', $slug)->delete();
  }
}
