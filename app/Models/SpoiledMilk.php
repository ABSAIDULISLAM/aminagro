<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpoiledMilk extends Model
{
    protected $table = "spoiled_milk";
    protected $fillable = [
        'quantity', 
        'account', 
        'date', 
        'price',
        'description',
    ];

}