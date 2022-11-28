<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarisCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventarisCategory_name'
    ];

    public function item (){
        return $this->hasMany(Inventaris::class);
    }
}
