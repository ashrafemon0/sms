<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable =[
        'time',
        'day',
        'assembly',
        'table_work',
        'group_work',
        'adl_activity',
        'massy_play',
        'snack_time',
        'table_work_2',
        'physical_exercise',

    ];
}
