<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Department;
use App\Models\inventaris;
use App\Models\LogsReport;
use Illuminate\Http\Request;
use App\Models\InventaryReport;
use App\Models\InventarisCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InventarisReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = DB::select("SELECT * from inventary_reports order by report_token asc");
        $user = $request->user();

        $checkActionAccess = $user->first_name . " " . $user->last_name;



        return view('inventaris_report.index', compact('data', 'checkActionAccess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $reportDate = Carbon::now()->format('d-m-Y');

        // $ifReport = InventaryReport::all();
        // if($ifReport === 0){

        //     $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first('id');
        // }else{
        //     $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first()->id;
        // }

        $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first()->id;

        $monthYear = $now->year . $now->month;
        $token = 'RPT' . $monthYear . sprintf('%03d', $order + 1);

        //department list select
        $data = Department::all();
        $category = InventarisCategory::all();

        return view('inventaris_report.create', compact('reportDate', 'token', 'data', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        InventaryReport::create($request->all());

        $request->accepts('session');
        session()->flash('success', 'Report has been added!');


        LogsReport::record(Auth::user(), Auth::user()->first_name,  ' added ', $request->report_token . ' to ', $request->inventarisCategory_name);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = InventaryReport::find($id);
        $user = $request->user();

        $checkExecutor = $user->first_name . " " . $user->last_name;

        $audits = InventaryReport::find($id)->audits;

        return view('inventaris_report.show', compact('data', 'user', 'checkExecutor', 'audits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = InventaryReport::find($id);

        $category = InventarisCategory::all();
        $department = Department::all();

        return view('inventaris_report.edit', compact('data', 'category', 'department'));
    }

    public function update(Request $request, $id)
    {

        InventaryReport::find($id)->update([
            'reporter_name' => $request->reporter_name,
            'department' => $request->department,
            'details_problem' => $request->details_problem,
            'reporter_contact' => $request->reporter_contact,
            'inventarisCategory_name' => $request->inventarisCategory_name,
            'end_date' => $request->end_date,
        ]);


        $request->accepts('session');
        session()->flash('success', 'Update successed!');

        LogsReport::record(Auth::user(), Auth::user()->first_name,  ' edited ', $request->report_token . ' in ', $request->inventarisCategory_name); 

        return redirect()->back();
    }


    // SOLUTION STUFF

    public function solution(Request $request, $id)
    {

        InventaryReport::find($id)->update([
            'executor' => $request->executor,
            'service_type' => $request->service_type,
            'status' => $request->status,
            'vendor_name' => $request->vendor_name,
            'start_service' => $request->start_service,
            'end_service' => $request->end_service,
            'solution' => $request->solution,
        ]);

        $request->accepts('session');
        session()->flash('success', 'Update successed!');

        return redirect()->back();
    }

    public function update_solution(Request $request, $id)
    {
        InventaryReport::find($id)->update(
            [
                'executor' => $request->executor,
                'service_type' => $request->service_type,
                'vendor_name' => $request->vendor_name,
                'start_service' => $request->start_service,
                'end_service' => $request->end_service,
                'solution' => $request->solution,
            ]
        );

        $request->accepts('session');
        session()->flash('success', 'Update successed!');

        LogsReport::record(Auth::user(), Auth::user()->first_name,  ' edited ', $request->report_token . ' in ', $request->inventarisCategory_name);

        return redirect()->back();
    }

    // Solution 2
    public function solution_2(Request $request, $id)
    {

        InventaryReport::where('id', $id)->update([
            'executor' => $request->executor,
            'service_type' => $request->service_type,
            'status' => $request->status,
            'vendor_name' => $request->vendor_name,
            'start_service' => $request->start_service,
            'end_service' => $request->end_service,
            'solution_2' => $request->solution,
        ]);

        $request->accepts('session');
        session()->flash('success', 'Update successed!');

        return redirect()->back();
    }

    public function update_solution_2(Request $request, $id)
    {
        InventaryReport::where('id', $id)->update(
            [
                'executor' => $request->executor,
                'service_type' => $request->service_type,
                'vendor_name' => $request->vendor_name,
                'start_service' => $request->start_service,
                'end_service' => $request->end_service,
                'solution_2' => $request->solution,
            ]
        );

        $request->accepts('session');
        session()->flash('success', 'Update successed!');

        return redirect()->back();
    }

    // Solution 3
    public function delete($id)
    {
        $data = InventaryReport::find($id);
        $data->delete();

        
        LogsReport::record(Auth::user(), Auth::user()->first_name, ' delete ', $data->report_token . ' on', $data->inventarisCategory_name);

        return redirect('/inventaris/report')->with('successDelete', 'Item has been deleted!');
    }

    public function activity_log()
    {

        $data = DB::select("SELECT * FROM logs_report ORDER BY created_at DESC");

        return view('inventaris_report.activityLog.index', compact('data'));
    }
}
