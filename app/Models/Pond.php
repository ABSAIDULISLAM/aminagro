<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    protected $table = "pond";
    protected $fillable = [
        'account_number', 'name', 'address'  
    ];
}
