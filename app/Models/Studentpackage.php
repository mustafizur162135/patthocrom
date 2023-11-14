<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentpackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'studentpackage_name',
        'studentpackage_price',
        'studentpackage_des',
        'studentpackage_image',
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'studentpackage_exam', 'studentpackage_id', 'exam_id');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'studentpackage_note', 'studentpackage_id', 'note_id');
    }

    public function orders()
    {
        return $this->hasMany(StudentOrder::class, 'studentpackage_id');
    }
}
