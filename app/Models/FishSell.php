<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishSell extends Model
{
    protected $table = "fish_sell";
    protected $fillable = ['pond','buyer','fish_name','qty','unit','price','total_price','paid_amount','date'];
}
