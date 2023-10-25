<?php

namespace App\Http\Controllers\Backend\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Imports\QuestionBankImport;
use App\Exports\QuestionBanksExport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
{
    $file = $request->file('file');

    // Excel::import(new QuestionBankImport, $file);

    return redirect()->route('your.import.route')->with('success', 'Data imported successfully');
}

public function showForm()
{
    return view('backend.question.import_form');
}

public function downloadSampleExcel()
{
    return Excel::download(new QuestionBanksExport, 'sample_question_banks.xlsx');
}


}
