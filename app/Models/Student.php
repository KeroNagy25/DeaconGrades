<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    protected $fillable = [
        'full_name',
        'age',
        'academic_year',
        'gender',
        'deacon_rank',
        'phone',
        'attendance_count',
        'attendance_grade',
        'hymns_grade',
        'coptic_grade',
        'theology_grade',
        'total',
    ];
}
