<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use Auth;

class CourseController extends Controller
{
    public function index() {
      $courses = Course::get();
      return view('courses.index', ['courses' => $courses]);
    }

    public function user() {
      $user = Auth::user();
      $user->load('courses');
      return view('courses.index', ['courses' => $user->courses()]);
    }

    public function store() {

    }

    public function delete() {

    }
}
