<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense_new extends Model
{
    protected $table = 'expenses_new';
    protected $fillable = ['purpose_id','date','amount','note','status','food','created_by'];
}
