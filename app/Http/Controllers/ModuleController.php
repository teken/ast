<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Module;
use Auth;

/**
* Controller that contains actions relating to the modules
*/
class ModuleController extends Controller
{
  /**
  * returns the module index view with all modules on it.
  */
  public function index(Request $request)
  {
    $modules = Module::get();
    return view('module.index', ['modules' => $modules]);
  }

  /**
  * returns the module details view for a specific module.
  */
  public function details(Request $request, $slug)
  {
    $module = Module::with('videos')->where('slug', $slug)->firstOrFail();
    return view('module.details', ['module' => $module]);
  }

  /**
  * returns the module edit view with a blank module.
  */
  public function new() {
    $module = new Module();
    $courses = Course::get();
    return view('module.edit', ['module' => $module, 'courses' => $courses, 'method' => 'PUT']);
  }

  /**
  * returns the module edit view with a specific module.
  */
  public function edit($slug) {
    $module = Module::where('slug', $slug)->firstOrFail();
    $courses = Course::get();
    return view('module.edit', ['module' => $module, 'courses' => $courses, 'method' => 'POST']);
  }

  /**
  * saves either new or edit module and redirects to the index action
  */
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

    if (Module::where('slug', $module->slug)->count() > 0){
      $nameParts = explode('_', $module->slug);
      $end = array_pop($nameParts);
      if (is_int($end)){
        $value = intval($end);
        array_push($nameParts, $value++);
      } else {
        array_push($nameParts, $end, '2');
      }
      $module->slug = implode('_', $nameParts);
    }

    $module->save();

    $courseids = $request->input('courseids');
    if($courseids != null) $module->courses()->sync($courseids);

    return redirect()->action('ModuleController@index');
  }

  /**
  * Deletes a specific module and redirects to the index action
  */
  public function delete($slug) {
    $module = Module::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $module->delete();
    return redirect()->action('ModuleController@index');
  }
}
