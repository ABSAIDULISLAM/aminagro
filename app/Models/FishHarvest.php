<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishHarvest extends Model
{
    protected $table = "fish_harvest";
    protected $fillable = ['pond','name','qty','price','due_price','pay_amount','total_price','date'];
}
