<?php

namespace App\Http\Controllers\Backend\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question_type;
use Illuminate\Support\Facades\Auth;

class QuestionTypeController extends Controller
{

    public $user;

  

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionTypes = Question_type::all();
        return view('backend.question_types.index', compact('questionTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_type_name' => 'required',
            'question_type_code' => 'required|unique:question_types',
        ]);

        Question_type::create($request->all());

        return redirect()->route('question_types.index')
            ->with('success', 'Question type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function show(Question_type $questionType)
    {
        return view('question_types.show', compact('questionType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function edit(Question_type $questionType)
    {
        return view('question_types.edit', compact('questionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question_type $questionType)
    {
        $request->validate([
            'question_type_name' => 'required',
            'question_type_code' => 'required|unique:question_types,question_type_code,' . $questionType->id,
        ]);

        $questionType->update($request->all());

        return redirect()->route('question_types.index')
            ->with('success', 'Question type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionType  $questionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question_type $questionType)
    {
        $questionType->delete();

        return redirect()->route('question_types.index')
            ->with('success', 'Question type deleted successfully.');
    }
}
