<?php

namespace App\Http\Controllers\Backend\student_exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentExamController extends Controller
{
    public function index()
    {

        $adminUserData = Session::get('student_user_data');

        $userID = $adminUserData['user_id'];

        $student = Student::with('orders')->where('id', $userID)->first();

        $studentPackage = $student->orders;
        if (empty($studentPackage)) {
            return $studentPackage->studentPackage;
        } else {

            $exams = Exam::where('exam_type', 'FREE')->paginate(10)->withQueryString();
        }

        return view('backend.student_exam.index', compact('exams'));
    }

    public function student_exam_question($id)
    {
        $exam = Exam::findOrFail($id);

        $questions = $exam->questions; // Assuming you have a 'questions' relationship in your Exam model

        return view('backend.exam_hall.index', compact('exam', 'questions'));
    }

    // Add this method to your controller
    public function getQuestions($examId, $startQuestionIndex)
    {
        $exam = Exam::findOrFail($examId);
        $questions = $exam->questions;

        // Determine the end index for questions
        $endQuestionIndex = min($startQuestionIndex + 1, count($questions) - 1);

        // Get the subset of questions based on the range
        $displayQuestions = array_slice($questions, $startQuestionIndex, 2);

        return view('backend.exam_hall.question', compact('displayQuestions', 'startQuestionIndex', 'endQuestionIndex'));
    }

    public function submit_answers(Request $request)
    {
        return $request;
        $exam = Exam::findOrFail($id);

        $questions = $exam->questions; // Assuming you have a 'questions' relationship in your Exam model

        return view('backend.exam_hall.index', compact('exam', 'questions'));
    }
}
