<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminYear extends Model
{
    protected $table = 'admin_year';
    protected $fillable = ['admin_id', 'academic_year'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
