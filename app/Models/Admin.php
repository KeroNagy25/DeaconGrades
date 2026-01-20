<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['name','email','password','superadmin'];

    public function years()
    {
        return $this->hasMany(AdminYear::class);
    }

    public function allowedYears()
    {
        return $this->years()->pluck('academic_year')->toArray();
    }
}
