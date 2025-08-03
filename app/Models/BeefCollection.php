<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeefCollection extends Model
{
    protected $table = "beef_collection";
    protected $fillable = [
        'cow', 
        'qty', 
        'unit', 
        'details', 
        'date',
    ];

}
