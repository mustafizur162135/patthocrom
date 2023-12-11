<?php

namespace App\Http\Controllers\Backend\exam;

use App\Http\Controllers\Controller;
use App\Models\Classname;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Http\Helpers\Helper;
use PDF;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::where('guard', 'admin')->get();

        return view('backend.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class_name = Classname::get();
        $subject = Subject::get();

        return view('backend.exam.create', compact('class_name', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
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

                // return $questions;

                // Check if $questions is empty and throw an exception
                if ($questions->isEmpty()) {
                    throw new \Exception('No questions found for the given criteria.');
                }

                $questionIds = $questions->pluck('id')->toArray();

                // Attach selected questions to the exam
                foreach ($questionIds as $question) {
                    $exam->questions()->attach($question);
                }
            });

            // Redirect or return a response
            return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->errors()]);
        } catch (QueryException $e) {
            // Handle Query errors
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Handle other exceptions
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::findOrFail($id);

        $questions = $exam->questions; // Assuming you have a 'questions' relationship in your Exam model

        return view('backend.exam.qc_pdf', compact('exam', 'questions'));
        $pdf = PDF::loadView('backend.exam.qc_pdf', compact('exam', 'questions'));

        return $pdf->stream('backend.exam.qc_pdf'); // Use 'download' instead of 'stream' to force download
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = exam::find($id);

        return view('backend.exam.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'exam_name' => 'required|string',
            'exam_code' => 'required',
        ]);

        // Find the exam by its ID
        $exam = exam::find($id);

        if (!$exam) {
            return redirect()->route('exams.index')->with('error', 'exam not found.');
        }

        // Update other fields
        $exam->exam_name = $request->input('exam_name');
        $exam->duration_minutes = $request->input('duration_minutes');
        $exam->exam_code = $request->input('exam_code');

        // Save the updated exam
        $exam->save();

        // Redirect or return a response
        return redirect()->route('exams.index')->with('success', 'exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the exam by its ID
        $exam = exam::find($id);

        if (!$exam) {
            return redirect()->route('exams.index')->with('error', 'exam not found.');
        }

        // Delete the slider record from the database
        $exam->delete();

        // Redirect or return a response
        return redirect()->route('exams.index')->with('success', 'exam deleted successfully.');
    }
}
