<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Module;
use App\User;
use Auth;

/**
* Controller that contains actions relating to the courses
*/
class CourseController extends Controller
{
  /**
  * returns the course index view with all courses on it.
  * Also eager loads the courses modules too.
  */
  public function index(Request $request) {
    $courses = Course::with('modules')->get();
    return view('course.index', ['courses' => $courses]);
  }

  /**
  * returns the course subscriptions view with the current users subscribed courses on it.
  * Also eager loads the courses modules and modules videos too.
  */
  public function user(Request $request) {
    $user = Auth::user();
    $user->load('courses.modules.videos');
    return view('course.subscriptions', ['courses' => $user->courses()->get()]);
  }

  /**
  * returns the course details view for a specific course.
  * Also
  */
  public function details(Request $request, $slug)
  {
    $course = Course::with(['modules','modules.videos'])->where('slug', $slug)->firstOrFail();
    return view('course.details', ['course' => $course]);
  }

  /**
  * returns the course edit view with a blank module.
  */
  public function new() {
    $course = new Course();
    $modules = Module::get();
    return view('course.edit', ['course' => $course, 'modules' => $modules, 'method' => 'PUT']);
  }

  /**
  * returns the course edit view with a specific course.
  */
  public function edit($slug) {
    $course = Course::where('slug', $slug)->firstOrFail();
    $modules = Module::get();
    return view('course.edit', ['course' => $course, 'modules' => $modules, 'method' => 'POST']);
  }

  /**
  * saves either new or edit course and redirects to the index action
  */
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

  /**
  * Deletes a specific course and redirects to the index action
  */
  public function delete($slug) {
    $course = Course::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $course->delete();
    return redirect()->action('CourseController@index');
  }

  /**
   * Subscribes the current user to a specific course and then redirects to the details action
   */
  public function subscribe(Request $request, $slug) {
    $course = Course::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->courses()->syncWithoutDetaching([$course->id]);
    return redirect()->action('CourseController@details', ['slug' => $course->slug]);
  }

  /**
   * Unsubscribes the current user to a specific course and then redirects to the details action
   */
  public function unsubscribe(Request $request, $slug) {
    $course = Course::where('slug', $slug)->firstOrFail();
    $user = Auth::user();
    $user->courses()->detach($course->id);
    return redirect()->action('CourseController@details', ['slug' => $course->slug]);
  }
}
