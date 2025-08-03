<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CowMedicineMonitorDtls extends Model
{
    protected $table = "cow_medicine_monitor_dtls";
    protected $fillable = [
        'monitor_id', 'vaccine_id', 'remarks','time' 
    ];
}
