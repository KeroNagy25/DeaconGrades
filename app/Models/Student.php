<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';

    public $incrementing = false;
    protected $keyType = 'string';

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
        'evaluation',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
