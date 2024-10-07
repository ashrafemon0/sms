<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeCategoryAmount extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_category_id',
        'class_id',
        'fee_category_amount'
    ];
    public function FeeCategory(){
        return $this->belongsTo(StudentFeeCategory::class,'fee_category_id','id');

    }


    public function FeeClass(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
}
