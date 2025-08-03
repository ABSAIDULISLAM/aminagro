<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    protected $table = "earning";
    protected $fillable = [
        'purpose_id', 'date', 'amount'
    ];
}
