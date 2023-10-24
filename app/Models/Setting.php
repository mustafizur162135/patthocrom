<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'contact_no',
        'mail',
        'about_us',
        'about_us_image',
        'logo',
        'banner_image',
        'fb_link',
        'youtube_link',
        'logo',
    ];
}
