<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'website',
        'about',
        'cover_photo',
        'first_name',
        'last_name',
        'country',
        'address',
    ];
}
