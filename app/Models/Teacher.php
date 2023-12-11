<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Teacher extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $guard = 'teacher';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    public function orders()
    {
        return $this->hasMany(StudentOrder::class, 'student_id')
            ->where('guard', 'teacher')
            ->where('studentorder_status', 1);
    }


    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'teacher_exams', 'teacher_id', 'exam_id');
    }

}
