<?php

namespace App\Http\Controllers\Backend\exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::get();

        return view('backend.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'exam_name' => 'required|string',
            'exam_code' => 'required',
        ]);

      
            // Create a new exam model
            $exam = new exam();
            $exam->exam_name = $request->input('exam_name');
            $exam->exam_code = $request->input('exam_code');
           
            $exam->save();

            // Redirect or return a response
            return redirect()->route('exams.index')->with('success', 'exam created successfully.');
       


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
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
