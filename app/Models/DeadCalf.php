<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadCalf extends Model
{
    protected $table = "dead_calf";
    protected $fillable = [
        'calf', 
        'description', 
        'date',
        'price',
    ];

}
