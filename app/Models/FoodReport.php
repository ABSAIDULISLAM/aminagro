<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodReport extends Model
{
	protected $table = 'food_report';
    protected $fillable = ['name'];
}
