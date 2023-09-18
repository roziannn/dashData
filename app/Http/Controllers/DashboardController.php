<?php

namespace App\Http\Controllers;

use App\Models\InventaryReport;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $dataInventary_sum = DB::select("SELECT count(code) as all from inventaris");
        $reportInventary_sum = DB::select("SELECT count(report_token) as all from inventary_reports");

        $dataItem = InventaryReport::all();

        LogActivity::record(Auth::user(), Auth::user()->first_name, 'accessing home page', 'this is extra log');

        // START CHART
        $departments = DB::table('departments')->get();  // get data departemen

        // Membuat daftar semua departemen yang ada di database
        $allDepartments = $departments->pluck('department_name')->toArray();

        // Mengambil data laporan untuk departemen-departemen yang memiliki laporan
        $reports = DB::table('inventary_reports')
            ->select('department', DB::raw('COUNT(*) as report_count'))
            ->whereIn('department', $allDepartments)
            ->groupBy('department')
            ->get();

        // Memisahkan data ke dalam $xValues (departemen) dan $yValues (jumlah laporan)
        $xValues = [];
        $yValues = [];

        foreach ($allDepartments as $department) {
            $report = $reports->firstWhere('department', $department);

            if ($report) {
                $xValues[] = $department;
                $yValues[] = intval($report->report_count); //intval() untuk memastikan perhitungannya dimulai dari 0
            } else {
                // Jika departemen tidak memiliki laporan, tambahkan dengan jumlah laporan 0
                $xValues[] = $department;
                $yValues[] = 0;
            }
        }
        //END CHART

        return view('dashboard.index', compact('dataInventary_sum', 'reportInventary_sum', 'dataItem', 'xValues', 'yValues'));
    }
}
