<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Module;
use App\User;
use Auth;

class CourseController extends Controller
{
    public function index(Request $request) {
      $courses = Course::with('modules')->get();
      return view('course.index', ['courses' => $courses]);
    }

    public function user(Request $request) {
      $user = Auth::user();
      $user->load('courses.modules.videos');
      return view('course.subscriptions', ['courses' => $user->courses()->get()]);
    }

    public function details(Request $request, $slug)
    {
      $course = Course::with(['modules','modules.videos'])->where('slug', $slug)->firstOrFail();
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

      if (Course::where('slug', $course->slug)->count() > 0){
        $nameParts = explode('_', $course->slug);
        $end = array_pop($nameParts);
        if (is_int($end)){
          $value = intval($end);
          array_push($nameParts, $value++);
        } else {
          array_push($nameParts, $end, '2');
        }
        $course->slug = implode('_', $nameParts);
      }

      $course->save();

      $moduleid = $request->input('moduleids');
      if($moduleid != null) $course->modules()->sync($moduleid);

      return redirect()->action('CourseController@index');
    }

    public function delete(Request $request, $slug) {
      Course::where('slug', $slug)->delete();
    }

    public function subscribe(Request $request, $slug) {
      $course = Course::where('slug', $slug)->firstOrFail();
      $user = Auth::user();
      $user->courses()->syncWithoutDetaching([$course->id]);
      return redirect()->action('CourseController@details', ['slug' => $course->slug]);
    }

    public function unsubscribe(Request $request, $slug) {
      $course = Course::where('slug', $slug)->firstOrFail();
      $user = Auth::user();
      $user->courses()->detach($course->id);
      return redirect()->action('CourseController@details', ['slug' => $course->slug]);
    }
}
