<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SickCow extends Model
{
    protected $table = "sick_cow";
    protected $fillable = [
        'cow', 
        'description', 
        'date',
    ];

}
