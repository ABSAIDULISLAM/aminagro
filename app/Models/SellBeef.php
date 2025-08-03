<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellBeef extends Model
{
    protected $table = "sell_beef";
    protected $fillable = [
        'customer', 
        'date', 
        'qty', 
        'price',
        'total_price',
        'due',
        'branch',
    ];

}