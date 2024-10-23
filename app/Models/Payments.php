<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'amount', 'months', 'late_fee', 'discount', 'payment_date'];
}
