<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventaryReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_token',
        'author',
        'reporter_name',
        'department',
        'details_problem',
        'reporter_contact',
        'report_date',
    ];
}
