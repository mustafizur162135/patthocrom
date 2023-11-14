<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'file_path'];

    public function studentpackages()
    {
        return $this->belongsToMany(Studentpackage::class, 'studentpackage_note', 'note_id', 'studentpackage_id');
    }
}
