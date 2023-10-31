<?php

namespace App\Http\Controllers\Backend\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\QuestionBankImport;
use App\Exports\QuestionBanksExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{

    public $user;


    public function __construct()
    {
        
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function import(Request $request)
{
    if (is_null($this->user) || !$this->user->can('question_import.create')) {
        abort(403, 'Sorry !! You are Unauthorized to view any admin !');
    }

    $file = $request->file('file');

    Excel::import(new QuestionBankImport, $file);

    return redirect()->route('question.import.form')->with('success', 'Data imported successfully');
}

public function showForm()
{
    if (is_null($this->user) || !$this->user->can('question_import.show')) {
        abort(403, 'Sorry !! You are Unauthorized to view any admin !');
    }
    return view('backend.question.import_form');
}

public function downloadSampleExcel()
{
    

    if (is_null($this->user) || !$this->user->can('question_export.downloade')) {
        abort(403, 'Sorry !! You are Unauthorized to view any admin !');
    }

    try {

        $response = Excel::download(new QuestionBanksExport, 'sample_question_banks.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    ob_end_clean();

    return $response;
        // return Excel::download(new QuestionBanksExport, 'sample_question_banks.xlsx');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to download the file. Please try again.');
    }
}


}
