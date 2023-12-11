<?php

namespace App\Http\Controllers\Backend\teacherQuestion;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Teacher;
use App\Models\Classname;
use App\Models\Subject;
use App\Models\TeacherPackage;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;




class TeacherQuestionController extends Controller
{

    public function index()
    {

        $adminUserData = Session::get('teacher_user_data');

        $userID = $adminUserData['user_id'];

        $teacher = Teacher::with('orders')->where('id', $userID)->first();

        $studentOrder = $teacher->orders;

        if (!empty($studentOrder)) {
            $packageIds = $studentOrder->pluck('studentpackage_id')->all();

            $packages = TeacherPackage::whereIn('id', $packageIds)->get();

            //  each package has exams relationship
            $teacherExams = $teacher->exams;



        } else {

            $teacherExams = [];
        }


        return view('backend.teacher_question.index', compact('teacherExams'));
    }

    public function create()
    {
        $class_name = Classname::get();
        $subject = Subject::get();

        return view('backend.teacher_question.create', compact('class_name', 'subject'));
    }
    // public function store(Request $request)
    // {
    //     // return $request;
    //     try {
    //         DB::transaction(function () use ($request) {
    //             // Validate the request data
    //             $request->validate([
    //                 'exam_name' => 'required|string|max:255',
    //                 'exam_code' => 'required|string|unique:exams,exam_code|max:255',
    //                 'exam_desc' => 'nullable|string',
    //                 'class_code' => 'required|array',
    //                 'sub_code' => 'required|array',
    //                 'total_qc' => 'required|integer|min:0',
    //             ]);

    //             // Create a new exam model
    //             $exam = new Exam();
    //             $exam->guard = Helper::activeGuard();
    //             $exam->exam_name = $request->input('exam_name');
    //             $exam->duration_minutes = $request->input('duration_minutes');
    //             $exam->exam_code = $request->input('exam_code');
    //             $exam->class_code = implode(',', $request->input('class_code'));
    //             $exam->sub_code = implode(',', $request->input('sub_code'));
    //             $exam->exam_desc = $request->input('exam_desc');
    //             $exam->total_qc = $request->input('total_qc');

    //             $exam->save();

    //             $userData = Session::get('teacher_user_data');

    //             $teacherID = $userData['user_id'];

    //             $teacher = Teacher::find($teacherID);
    //             $teacher->exams()->attach($exam->id);

    //             // Now prepare questions
    //             $classCodes = $request->input('class_code');
    //             $subCodes = $request->input('sub_code');

    //             $questions = DB::table('question_banks');

    //             foreach ($classCodes as $classCode) {
    //                 $questions->orWhereRaw("FIND_IN_SET('$classCode', class_code)");
    //             }

    //             foreach ($subCodes as $subCode) {
    //                 $questions->orWhereRaw("FIND_IN_SET('$subCode', sub_code)");
    //             }

    //             $questions = $questions->inRandomOrder()
    //                 ->limit($exam->total_qc)
    //                 ->get();

    //             // return $questions;

    //             // Check if $questions is empty and throw an exception
    //             if ($questions->isEmpty()) {
    //                 throw new \Exception('No questions found for the given criteria.');
    //             }

    //             $questionIds = $questions->pluck('id')->toArray();

    //             // Attach selected questions to the exam
    //             foreach ($questionIds as $question) {
    //                 $exam->questions()->attach($question);
    //             }


    //         });

    //         // Redirect or return a response
    //         return redirect()->route('teacher.qc_print')->with('success', 'Exam created successfully.');
    //     } catch (ValidationException $e) {
    //         // Handle validation errors
    //         return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->errors()]);
    //     } catch (QueryException $e) {
    //         // Handle Query errors
    //         return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->getMessage()]);
    //     } catch (\Exception $e) {
    //         // Handle other exceptions
    //         return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->getMessage()]);
    //     }
    // }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // Validate the request data
                $request->validate([
                    'exam_name' => 'required|string|max:255',
                    'exam_code' => 'required|string|unique:exams,exam_code|max:255',
                    'exam_desc' => 'nullable|string',
                    'class_code' => 'required|array',
                    'sub_code' => 'required|array',
                    'total_qc' => 'required|integer|min:0',
                ]);

                // Create a new exam model
                $exam = new Exam();
                $exam->guard = Helper::activeGuard();
                $exam->exam_name = $request->input('exam_name');
                $exam->duration_minutes = $request->input('duration_minutes');
                $exam->exam_code = $request->input('exam_code');
                $exam->class_code = implode(',', $request->input('class_code'));
                $exam->sub_code = implode(',', $request->input('sub_code'));
                $exam->exam_desc = $request->input('exam_desc');
                $exam->total_qc = $request->input('total_qc');
                $exam->save();

                // Check if total_qc is sufficient
                if ($exam->total_qc <= 0) {
                    throw new \Exception('Insufficient balance to create the exam.');
                }

                $userData = Session::get('teacher_user_data');
                $teacherID = $userData['user_id'];

                $teacher = Teacher::find($teacherID);

                // Check if teacher has sufficient balance
                if ($teacher->total_buy_question < $exam->total_qc) {
                    throw new \Exception('Insufficient Question balance to create the exam.');
                }



                $teacher->exams()->attach($exam->id);

                // Now prepare questions
                $classCodes = $request->input('class_code');
                $subCodes = $request->input('sub_code');

                $questions = DB::table('question_banks');

                foreach ($classCodes as $classCode) {
                    $questions->orWhereRaw("FIND_IN_SET('$classCode', class_code)");
                }

                foreach ($subCodes as $subCode) {
                    $questions->orWhereRaw("FIND_IN_SET('$subCode', sub_code)");
                }

                $questions = $questions->inRandomOrder()
                    ->limit($exam->total_qc)
                    ->get();

                // Check if $questions is empty and throw an exception
                if ($questions->isEmpty()) {
                    throw new \Exception('No questions found for the given criteria.');
                }

                $questionIds = $questions->pluck('id')->toArray();

                // Attach selected questions to the exam
                foreach ($questionIds as $question) {
                    $exam->questions()->attach($question);
                }

                // Update the Teacher model fields
                $teacher->total_buy_question -= $exam->total_qc;
                $teacher->total_print_question += $exam->total_qc;
                $teacher->due_to_print = max(0, $teacher->total_buy_question - $teacher->total_print_question);

                $teacher->save();
            });

            // Redirect or return a response
            return redirect()->route('teacher.qc_print')->with('success', 'Exam created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->errors()]);
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->getMessage()]);
        }
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
