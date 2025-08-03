<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyMedicine extends Model
{
    protected $table = "buy_medicine";
    protected $fillable = [
        'branch',
        'suppliers',
        'medicine',
        'quantity',
        'unit',
        'price',
        'description',
        'date',
        'purpose_id',
    ];

    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine', 'medicine');
    }

    public function vaccine()
    {
        return $this->belongsTo('App\Models\Vaccine', 'medicine');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'suppliers');
    }

}
