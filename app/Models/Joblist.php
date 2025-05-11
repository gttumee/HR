<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joblist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'salary',
        'type',
        'language_level',
        'detail',
        'number',
        'company_name',
        'phone',
        'mail',
    ];    
}