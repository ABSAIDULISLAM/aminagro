<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermanentExpense extends Model
{
    protected $table = "permanent_expense";
    protected $fillable = [
        'name', 
        'description', 
        'status', 
        'price',
        'date',
        'cow',
    ];

}
