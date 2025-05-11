<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'name', 'deployment_date', 'status'
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}