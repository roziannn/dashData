<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'brand',
        'inventarisCategory_name',
        'reg_code',
        'year',
        'condition',
        'location',
        'department',
        'used_by',
        'others',
    ];
}