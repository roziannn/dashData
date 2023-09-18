<?php

namespace App\Http\Controllers;

use App\Models\InventaryReport;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        
        $dataInventary_sum = DB::select("SELECT count(code) as all from inventaris");
        
        $reportInventary_sum = DB::select("SELECT count(report_token) as all from inventary_reports");

        // $service_type = DB::select("SELECT count(service_type) as services from inventary_reports");

        $dataItem = InventaryReport::all();

        LogActivity::record(Auth::user(), Auth::user()->first_name, 'accessing home page', 'this is extra log');

        return view('dashboard.index', compact('dataInventary_sum', 'reportInventary_sum', 'dataItem'));
    }

}
