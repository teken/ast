<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use Auth;

class CourseController extends Controller
{
    public function index(Request $request) {
      $courses = Course::get();
      return view('courses.index', ['courses' => $courses]);
    }

    public function user(Request $request) {
      $user = Auth::user();
      $user->load('courses');
      return view('courses.index', ['courses' => $user->courses()]);
    }

    public function details(Request $request, $slug)
    {
      $course = Course::where('slug', $slug)->get();
      return view('course.details', ['course' => $course])
    }

    public function store() {

    }

    public function delete(Request $request, $slug) {
      Course::where('slug', $slug)->delete();
    }
}
