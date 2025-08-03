<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CowMedicineMonitor extends Model
{
    protected $table = "cow_medicine_monitor";
    protected $fillable = [
        'shed_no', 'cow_id', 'date', 'note', 'user_id', 'branch_id' 
    ];
}
