<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFutureChange extends Model
{
    use HasFactory;

    // Add employee_id to the fillable property
    protected $fillable = [
        'employee_id', // Add this line
        'changes',
        'effective_date',
    ];
}
