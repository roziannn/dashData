<?php

namespace App\Exports;

use App\Models\inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventaryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return inventaris::all();
    }
}
