<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_bank extends Model
{
    use HasFactory;
    protected $table = 'question_banks'; // Define the table name

    protected $primaryKey = 'id'; // Specify the primary key field

    protected $fillable = [
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
        'status',
    ];

     // Define the relationship with QuestionDiffLevel (Many-to-One)
     public function questionDiffLevel()
     {
         return $this->belongsTo(Question_diff_level::class, 'question_diff_code', 'question_diff_level_code');
     }
 
     // Define the relationship with QuestionType (Many-to-One)
     public function questionType()
     {
         return $this->belongsTo(Question_type::class, 'question_type_code', 'question_type_code');
     }


     public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_bank_id', 'exam_id');
    }
}
