<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_diff_level extends Model
{
    use HasFactory;

    protected $table = 'question_diff_levels'; // Define the table name

    protected $primaryKey = 'id'; // Specify the primary key field

    protected $fillable = [
        'question_diff_level_name',
        'question_diff_level_code',
    ];
     // Define the inverse relationship with QuestionBank (One-to-Many)
     public function questionBanks()
     {
         return $this->hasMany(Question_bank::class, 'question_diff_code', 'question_diff_level_code');
     }
}
