<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = "groups";
    protected $fillable = [
        'group_name'
    ];

    public function animals()
    {
        return $this->belongsToMany(Animal::class, 'animal_groups', 'group_id', 'animal_id')->withTimestamps();
    }

}
