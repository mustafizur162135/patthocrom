<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classname extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_name',
        'class_code',
        'class_note',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}
