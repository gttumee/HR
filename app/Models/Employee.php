<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'deployment_id','first_name', 'last_name', 'email', 'phone', 'dob', 'position', 'salary', 'hire_date', 'resignation_date', 'resignation_reason','address','job_type','person_additional','job_additional'
    ];
    
    public function deployment()
    {
        return $this->belongsTo(Deployment::class);
    }
}