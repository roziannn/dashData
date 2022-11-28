<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        
        $dataInventary_sum = DB::select("SELECT count(code) as all from inventaris");
        

        return view('dashboard.index', compact('dataInventary_sum'));
    }

}
