<?php
namespace App\Imports;

use App\Models\Question_bank; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionBankImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question_bank([
            'question_code' => $row['question_code'],
            'class_code' => $row['class_code'],
            'sub_code' => $row['sub_code'],
            'question_diff_code' => $row['question_diff_code'],
            'question_type_code' => $row['question_type_code'],
            'question_name' => $row['question_name'],
            'question_option_1' => $row['question_option_1'],
            'question_option_2' => $row['question_option_2'],
            'question_option_3' => $row['question_option_3'],
            'question_option_4' => $row['question_option_4'],
            'question_option_5' => $row['question_option_5'],
            'question_option_6' => $row['question_option_6'],
            'question_correct_ans' => $row['question_correct_ans'],
            'question_default_marks' => $row['question_default_marks'],
            'question_default_time_to_solve' => $row['question_default_time_to_solve'],
            'question_hint' => $row['question_hint'],
            'question_solution' => $row['question_solution'],
            'visibility' => $row['visibility'],
            'is_paid' => $row['is_paid'],
            'status' => $row['status'],
        ]);
    }
}
