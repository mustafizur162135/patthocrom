<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classname;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Studentpackage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $setting = Setting::first();
        $sliders = Slider::get();
        $courses = Classname::take(8)->get();
        $studentpackages = Studentpackage::take(6)->get();
        $studentUserData = Session::get('student_user_data');

        return view('frontend.home', compact('setting','sliders','courses','studentUserData','studentpackages'));
    }
  

    public function showSinglePackage($id)
    {
        $studentPackage = Studentpackage::find($id);
        $setting = Setting::first();
        $studentUserData = Session::get('student_user_data');

        if (!$studentPackage) {
            abort(404); // Package not found, return a 404 error page.
        }

        return view('frontend.package.show', compact('studentPackage','setting','studentUserData'));
    }


    public function course()
    {
        $setting = Setting::first();
        $courses = ClassName::paginate(9);
        return view('frontend.course.course', compact('setting','courses'));
    }
}



