<?php

namespace App\Http\Controllers\Backend\student_exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Support\Facades\Session;

class StudentExamController extends Controller
{
    public function index()
    {

        $adminUserData = Session::get('student_user_data');

        $userID = $adminUserData['user_id'];

        $student = Student::with('orders')->where('id', $userID)->first();

        $studentPackage = $student->orders;
        if ($studentPackage) {
            $exams = Exam::where('exam_type', 'FREE')->get();
        }

        return view('backend.student_exam.index', compact('exams'));
    }

    public function show($id)
    {
        $exam = Exam::findOrFail($id);

        $questions = $exam->questions; // Assuming you have a 'questions' relationship in your Exam model

        return view('backend.exam.qc_pdf', compact('exam', 'questions'));
        $pdf = PDF::loadView('backend.exam.qc_pdf', compact('exam', 'questions'));

        return $pdf->stream('backend.exam.qc_pdf'); // Use 'download' instead of 'stream' to force download
    }
}
