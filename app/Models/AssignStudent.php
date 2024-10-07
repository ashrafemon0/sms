<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;
    protected $fillable =[
        'student_id',
        'class_id',
        'year_id',
        'group_id',
        'shift_id',
    ];
    public function student(){

        return $this->belongsTo(User::class,'student_id','id');
    }
    public function student_class(){

        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
    public function student_year(){

        return $this->belongsTo(StudentYear::class,'year_id','id');
    }
    public function discount(){

        return $this->belongsTo(DiscountStudent::class,'id','assign_student_id');
    }
    public function s_group(){

        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }
    public function s_shift(){

        return $this->belongsTo(StudentShift::class,'shift_id','id');
    }
    public function studentData(){

        return $this->belongsTo(StudentData::class, 'student_id', 'id'); // Use StudentData if that's the table
    }


}
