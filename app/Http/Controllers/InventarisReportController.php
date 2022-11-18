<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Department;
use App\Models\inventaris;
use App\Models\InventarisCategory;
use Illuminate\Http\Request;
use App\Models\InventaryReport;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class InventarisReportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::select("SELECT * from inventary_reports order by report_token asc");
    
        return view('inventaris_report.index', compact('data'));
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
        $token = 'RPT'. $monthYear . sprintf('%03d', $order + 1);
    
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

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = InventaryReport::find($id);


        return view('inventaris_report.show', compact('data'));
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

        return view('inventaris_report.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        InventaryReport::where('id', $id)->update([
            'reporter_name'=> $request->reporter_name,
            'department'=> $request->department,
            'details_problem'=> $request->details_problem,
            'reporter_contact'=> $request->reporter_contact,
            'status'=> $request->status,
            'inventarisCategory_name'=> $request->inventarisCategory_name,
            'end_date'=> $request->end_date,
        ]);


        $request->accepts('session');
        session()->flash('success', 'Berhasil mengubah data pegawai!');

        return redirect()->back();
    }

    public function solution(Request $request, $id)
    {
        
        InventaryReport::where('id', $id)->update([
            'executor'=> $request->executor,
            'service_type'=> $request->service_type,
            'vendor_name'=> $request->vendor_name,
            'start_service'=> $request->start_service,
            'end_service'=> $request->end_service,
            'solution'=> $request->solution,
        ]);

        $request->accepts('session');
        session()->flash('success', 'Berhasil mengubah data pegawai!');

        return redirect()->back();
    }

    public function update_solution(Request $request, $id)
    {
        
        InventaryReport::where('id', $id)->updateOrCreate([
            'service_type'=> $request->service_type,
            'vendor_name'=> $request->vendor_name,
            'start_service'=> $request->start_service,
            'end_service'=> $request->end_service,
            'solution'=> $request->solution,
        ]);

        $request->accepts('session');
        session()->flash('success', 'Berhasil mengubah data pegawai!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = InventaryReport::find($id);
        $data->delete();

        return redirect('/inventaris/report')->with('successDelete', 'Item has been deleted!');
    }
}
