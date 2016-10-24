<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Module;
use Auth;

class CourseController extends Controller
{
    public function index(Request $request) {
      $courses = Course::with('modules')->get();
      return view('course.index', ['courses' => $courses]);
    }

    public function user(Request $request) {
      $user = Auth::user();
      $user->load('courses');
      return view('course.index', ['courses' => $user->courses()]);
    }

    public function details(Request $request, $slug)
    {
      $course = Course::with('modules.videos')->where('slug', $slug)->firstOrFail();
      return view('course.details', ['course' => $course]);
    }

    public function new() {
      $course = new Course();
      $modules = Module::get();
      return view('course.edit', ['course' => $course, 'modules' => $modules, 'method' => 'PUT']);
    }

    public function edit($slug) {
      $course = Course::where('slug', $slug)->firstOrFail();
      $modules = Module::get();
      return view('course.edit', ['course' => $course, 'modules' => $modules, 'method' => 'POST']);
    }

    public function store(Request $request) {
      $course;
      if ($request->isMethod('post')) {
        $course = Course::findOrFail($request->input('id'));
      } else if ($request->isMethod('put')) {
        $course = new Course();
      }

      $course->title = $request->input('title');
      $course->description = $request->input('description');
      $course->slug = str_slug($course->title);
      $courses->modules() = Module::whereIn('slug', $request->input('moduleslugs'))->get();

      $course->save();

      return redirect()->action('CourseController@index');
    }

    public function delete(Request $request, $slug) {
      Course::where('slug', $slug)->delete();
    }
}
