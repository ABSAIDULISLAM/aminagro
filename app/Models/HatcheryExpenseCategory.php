<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HatcheryExpenseCategory extends Model
{
    protected $table = "hatchery_expense_category";
    protected $fillable = ['name'];
}
