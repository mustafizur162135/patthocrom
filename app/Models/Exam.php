<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'exam_name',
        'exam_code',
    ];

    // Define the "studentPackages" relationship
    public function studentpackages()
    {
        return $this->belongsToMany(Studentpackage::class, 'studentpackage_exam', 'exam_id', 'studentpackage_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question_bank::class, 'exam_questions', 'exam_id', 'question_bank_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_exams', 'exam_id', 'teacher_id');
    }
}
