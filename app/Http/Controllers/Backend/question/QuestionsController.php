<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use App\Models\Question_bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\DataTables;


class QuestionsController extends Controller
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
    public function index(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('question.list')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        if ($request->ajax()) {
            $questions = Question_bank::select('*');
            
            return DataTables::of($questions)
            ->addColumn('action', function ($question) {
                // Define the action buttons with icons
                $editButton = '<a href="' . route('questions.edit', $question->id) . '" class="btn btn-danger"><i class="fa fa-edit"></i> </a>';
                $showButton = '<a href="' . route('questions.show', $question->id) . '" class="btn btn-info"><i class="fa fa-eye"></i> </a>';
                $deleteButton = '<a href="' . route('questions.destroy', $question->id) . '" class="btn btn-danger" data-method="delete" data-token="' . csrf_token() . '"><i class="fa fa-trash"></i></a>';
        
                return $editButton . ' | ' . $showButton . ' | ' . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        }
    
        return view('backend.question.index');

        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('question.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('question.store')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question_bank  $question_bank
     * @return \Illuminate\Http\Response
     */
    public function show(Question_bank $question_bank)
    {
        if (is_null($this->user) || !$this->user->can('question.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question_bank  $question_bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Question_bank $question_bank)
    {
        if (is_null($this->user) || !$this->user->can('question.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question_bank  $question_bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question_bank $question_bank)
    {
        if (is_null($this->user) || !$this->user->can('question.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question_bank  $question_bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question_bank $question_bank)
    {
        if (is_null($this->user) || !$this->user->can('question.destroy')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
    
    }
}
