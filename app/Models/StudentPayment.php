<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_name',
        'class_name',
        'cat_name',
        'user_id',
        'date',
        'amount',
        'remark',
        'payment_method'
    ];
}
