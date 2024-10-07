<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGrade extends Model
{
    use HasFactory;
    protected $fillable =[
        'grade_name',
        'grade_point',
        'start_mark',
        'end_mark',
        'start_point',
        'end_point',
        'remarks'
    ];
}
