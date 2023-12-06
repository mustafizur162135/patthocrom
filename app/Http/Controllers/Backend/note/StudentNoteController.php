<?php

namespace App\Http\Controllers\backend\note;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Studentpackage;
use Illuminate\Support\Facades\Session;

class StudentNoteController extends Controller
{
    public function index()
    {

        $adminUserData = Session::get('student_user_data');

        $userID = $adminUserData['user_id'];

        $student = Student::with('orders')->where('id', $userID)->first();

          $studentOrder = $student->orders;

        if (!empty($studentOrder)) {
            $packageIds = $studentOrder->pluck('studentpackage_id')->all();

            $packages = Studentpackage::whereIn('id', $packageIds)->get();

            // Assuming each package has exams relationship
            $notes = $packages->flatMap->notes;







        } else {

            $exams = Exam::where('exam_type', 'FREE')->paginate(10)->withQueryString();

            $notes=$exams->notes;
        }

        return view('backend.studentnote.index', compact('notes'));


    }
}
