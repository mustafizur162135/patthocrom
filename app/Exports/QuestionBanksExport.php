<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuestionBanksExport implements FromCollection, WithHeadings
{
    protected $headings = [
        'question_code',
        'class_code',
        'sub_code',
        'question_diff_code',
        'question_type_code',
        'question_name',
        'question_option_1',
        'question_option_2',
        'question_option_3',
        'question_option_4',
        'question_option_5',
        'question_option_6',
        'question_correct_ans',
        'question_default_marks',
        'question_default_time_to_solve',
        'question_hint',
        'question_solution',
        'visibility',
        'is_paid',
        'status'
    ];

    protected $sampleQuestion = [
        'question_code' => 'QB001',
        'class_code' => 'C001',
        'sub_code' => 'S001',
        'question_diff_code' => 'DIFF1',
        'question_type_code' => 'TYPE1',
        'question_name' => 'Sample Question 1',
        'question_option_1' => 'Option A',
        'question_option_2' => 'Option B',
        'question_option_3' => 'Option C',
        'question_option_4' => 'Option D',
        'question_option_5' => 'Option E',
        'question_option_6' => 'Option F',
        'question_correct_ans' => 'A',
        'question_default_marks' => '5',
        'question_default_time_to_solve' => '60',
        'question_hint' => 'This is a hint for question 1',
        'question_solution' => 'This is the solution for question 1',
        'visibility' => 'public',
        'is_paid' => 0,
        'status' => 1
    ];

    public function collection()
    {
        return collect([$this->sampleQuestion]);
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
