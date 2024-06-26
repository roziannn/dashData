<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Inventaris;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Models\InventaryReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $dataInventary_sum = DB::select("SELECT count(code) as all from inventaris");
        $reportInventary_sum = DB::select("SELECT count(report_token) as all from inventary_reports");

        $total_department = DB::select("SELECT count(department_name) as all from departments");


        $dataItem = InventaryReport::all();

        LogActivity::record(Auth::user(), Auth::user()->first_name, 'accessing home page', 'this is extra log');

        //START CHART MOST REPORTS BASED ON DEPARTMENT
        $departments = DB::table('departments')->get();  //get data departemen
        $allDepartments = $departments->pluck('department_name')->toArray(); //create daftar semua departemen yang ada di database

        // get data laporan untuk departemen-departemen yang memiliki laporan
        $reports = DB::table('inventary_reports')
            ->select('department', DB::raw('COUNT(*) as report_count'))
            ->whereIn('department', $allDepartments)
            ->groupBy('department')
            ->get();
        $xValues = [];
        $yValues = [];

        foreach ($allDepartments as $department) {
            $report = $reports->firstWhere('department', $department);
            if ($report) {
                $xValues[] = $department;
                $yValues[] = intval($report->report_count); //intval() memastikan perhitungannya dimulai dari 0
            } else {
                $xValues[] = $department;
                $yValues[] = 0;    // Jika departemen tidak memiliki laporan, tambahkan dengan jumlah laporan 0
            }
        }
        //END CHART MOST REPORTS BASED ON DEPARTMENT

        //START CHART MOST REPORTS BASED ON CATEGORY
        $categories = DB::table('inventaris_categories')->get();  // Get data kategori inventaris
        $allCategories = $categories->pluck('inventarisCategory_name')->toArray();

        // get data laporan untuk kategori-kategori yang memiliki laporan
        $reports = DB::table('inventary_reports')
            ->select('inventarisCategory_name', DB::raw('COUNT(*) as report_count'))
            ->whereIn('inventarisCategory_name', $allCategories)
            ->groupBy('inventarisCategory_name')
            ->get();
        $xCtgValues = [];
        $yCtgValues = [];

        foreach ($allCategories as $category) {
            $report = $reports->firstWhere('inventarisCategory_name', $category);
            if ($report) {
                $xCtgValues[] = $category;
                $yCtgValues[] = intval($report->report_count);
            } else {
                $xCtgValues[] = $category;
                $yCtgValues[] = 0;
            }
        }
        //END CHART MOST REPORTS BASED ON CATEGORY


        //START GRAFIK LINE 3 BULAN TERAKHIR REPORT
        $endDate = now();
        $startDateWeek = now()->subDays(7);
        $startDateMonth = now()->subMonth(3);

        $dataRange = InventaryReport::whereBetween('created_at', [$startDateMonth, $endDate])->groupBy('date')->orderBy('date')->get([
            DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as report_count'),
        ]);

        $dates = $dataRange->pluck('date');
        $reports = $dataRange->pluck('report_count');
        //END


        //START DATA INVENTRAY BY CONDITION
        $conditions = Inventaris::select('condition', DB::raw('count(*) as total'))
            ->groupBy('condition')
            ->get()->prepend(['condition' => '0', 'total' => 0]);

        //END


        return view('dashboard.index', compact('dataInventary_sum', 'reportInventary_sum', 'total_department', 'dataItem', 'xValues', 'yValues', 'xCtgValues', 'yCtgValues', 'startDateWeek', 'startDateMonth', 'dates', 'reports', 'conditions'));
    }
}
