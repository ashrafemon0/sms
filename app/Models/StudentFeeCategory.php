<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeeCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function amount()
    {
        return $this->hasOne(StudentFeeCategoryAmount::class, 'fee_category_id', 'id');
    }

}
