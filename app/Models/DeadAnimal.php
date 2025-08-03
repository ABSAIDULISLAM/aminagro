<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadAnimal extends Model
{
    protected $table = "dead_animal";
    protected $fillable = [
        'cow', 
        'description', 
        'date',
        'price',
    ];

}
