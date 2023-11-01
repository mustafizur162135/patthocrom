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

    // Define the "student" relationship
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function orders()
    {
        return $this->hasMany(StudentOrder::class, 'studentpackage_id');
    }
}
