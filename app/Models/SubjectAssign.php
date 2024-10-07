<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectAssign extends Model
{
    use HasFactory;
    protected $fillable =[
        'class_id',
        'subject_id',
        'full_mark',
        'pass_mark',
        'subjective_mark'
    ];

    public function SubjectClass(){
        return $this->belongsTo(StudentClass::class,'class_id','id');

    }
    public function FeeClass(){
        return $this->belongsTo(StudentSubject::class,'subject_id','id');
    }
}
