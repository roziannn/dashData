<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventaryReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_token',
        'report_date',
        'author',
        'reporter_name',
        'department',
        'details_problem',
        'reporter_contact',
        'end_date',
        //
        'status',
        'vendor_name',
        'start_service',
        'end_Service',
        'solution',
    ];
}
