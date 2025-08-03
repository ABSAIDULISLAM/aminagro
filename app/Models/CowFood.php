<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CowFood extends Model
{
    protected $table = "cow_food";
        protected $fillable = [
        'branch',
        'supplier',
        'food',
        'quantity',
        'unit',
        'price',
        'date',
        'description',
    ];

}
