<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FishStocking extends Model
{
    protected $table = "fish_stocking";
    protected $fillable = ['fish_name','qty','price','date','pond'];
}
