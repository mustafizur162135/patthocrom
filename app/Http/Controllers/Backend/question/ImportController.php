<?php

namespace App\Http\Controllers\Backend\question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\QuestionBankImport;
use App\Exports\QuestionBanksExport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request)
{
    $file = $request->file('file');

    Excel::import(new QuestionBankImport, $file);

    return redirect()->route('your.import.route')->with('success', 'Data imported successfully');
}

public function showForm()
{
    return view('backend.question.import_form');
}

public function downloadSampleExcel()
{
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
