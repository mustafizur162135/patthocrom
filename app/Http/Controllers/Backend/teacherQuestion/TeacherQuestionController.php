<?php

namespace App\Http\Controllers\Backend\teacherQuestion;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Teacher;
use App\Models\TeacherPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherQuestionController extends Controller
{

    public function index()
    {
       
        $adminUserData = Session::get('teacher_user_data');

        $userID = $adminUserData['user_id'];

       return $student = Teacher::with('orders')->where('id', $userID)->first();

          $studentOrder = $student->orders;

        if (!empty($studentOrder)) {
            $packageIds = $studentOrder->pluck('studentpackage_id')->all();

            $packages = TeacherPackage::whereIn('id', $packageIds)->get();

            //  each package has exams relationship
            $exams = $packages->flatMap->exams;



        } else {

            $exams = Exam::where('exam_type', 'FREE')->paginate(10)->withQueryString();
        }


        return view('backend.teacher_question.index', compact('exams'));
    }
}
