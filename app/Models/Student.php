<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    protected $guard = 'student';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function orders()
    {
        return $this->hasMany(StudentOrder::class, 'student_id')->where('guard', 'student')->where('studentorder_status', 1);
    }
}
