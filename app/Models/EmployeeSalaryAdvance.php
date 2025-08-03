<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryAdvance extends Model
{
    protected $table = "employee_salary_advance_payment";

    protected $fillable = ['employee_id','date','advance', 'note'];
}
