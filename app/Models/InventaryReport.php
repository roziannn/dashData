<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class InventaryReport extends Model implements Auditable
{

    
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'report_token',
        'report_date',
        'author',
        'reporter_name',
        'department',
        'details_problem',
        'reporter_contact',
        'status',
        'inventarisCategory_name',
        'executor',
        'end_date',
        //
        'service_type',
        'vendor_name',
        'start_service',
        'end_Service',
        'solution',

        
        'solution_2',
        'solution_2_add_at',
    ];
}
