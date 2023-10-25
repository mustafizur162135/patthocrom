<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Classname;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $setting = Setting::first();
        $sliders = Slider::get();
        $courses = Classname::take(8)->get();

        return view('frontend.home', compact('setting','sliders','courses'));
    }

    public function course()
    {
        $setting = Setting::first();
        $courses = ClassName::paginate(9);
        return view('frontend.course.course', compact('setting','courses'));
    }
}



