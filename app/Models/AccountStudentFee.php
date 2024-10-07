<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    use HasFactory;
    protected $fillable =[
        'year_id',
        'class_id',
        'student_id',
        'fee_category_id',
        'date',
        'amount'
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
    public function fee_category(){

        return $this->belongsTo(StudentFeeCategory::class,'fee_category_id','id');
    }
    public function s_shift(){

        return $this->belongsTo(StudentShift::class,'shift_id','id');
    }
}
