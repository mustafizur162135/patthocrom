<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'guard',
        'studentpackage_id',
        'studentorder_date',
        'studentorder_card_type',
        'nagadTranId',
        'bkashTranId',
        'studentpackage_name',
        'studentpackage_price',
        'studentorder_code',
        'studentorder_name',
        'studentorder_phone',
        'studentorder_email',
        'studentorder_address',
        'studentorder_zipcode',
        'studentorder_city',
        'studentorder_status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'student_id');
    }

    public function studentPackage()
    {
        return $this->belongsTo(StudentPackage::class, 'studentpackage_id');
    }
}