<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_type extends Model
{
    use HasFactory;

    protected $table = 'question_types'; // Define the table name

    protected $primaryKey = 'id'; // Specify the primary key field

    protected $fillable = [
        'question_type_name',
        'question_type_code',
    ];

    // Define the inverse relationship with QuestionBank (One-to-Many)
    public function questionBanks()
    {
        return $this->hasMany(Question_bank::class, 'question_type_code', 'question_type_code');
    }
}
