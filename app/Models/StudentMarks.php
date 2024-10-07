<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
    use HasFactory;
    protected $fillable =[
        'student_id',
        'id_no',
        'class_id',
        'year_id',
        'subject_id',
        'marks'
    ];
    public function student(){
        return $this->belongsTo(user::class,'user_id','id');
    }
}
