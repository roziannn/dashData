<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        
        $dataInventary_sum = DB::select("SELECT count(code) as all from inventaris");
        
        $reportInventary_sum = DB::select("SELECT count(report_token) as all from inventary_reports");

        return view('dashboard.index', compact('dataInventary_sum', 'reportInventary_sum'));
    }

}
