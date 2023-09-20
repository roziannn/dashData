<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventaryLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'floor'
    ];

    public function item (){
        return $this->hasMany(InventaryLocation::class);
    }
}
