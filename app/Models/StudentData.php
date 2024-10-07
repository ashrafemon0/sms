<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentData extends Model
{
    use HasFactory;
    protected $fillable = [
        'year_id',
        'class_id',
        'name',
        'student_id',
        'pdf_path',
    ];

}
