<?php

namespace App\Http\Controllers;

use App\Models\inventaris;
use App\Models\InventaryReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $data = InventaryReport::all();
    
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
        $reportDate = Carbon::now()->format('d/m/Y');
        
        // $ifReport = InventaryReport::all();
        // if($ifReport === 0){

        //     $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first('id');
        // }else{
        //     $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first()->id;
        // }

        $order = DB::table('inventary_reports')->orderBy('id', 'desc')->first()->id;

        $monthYear = $now->year . $now->month;
        $token = 'RPT'. $monthYear . sprintf('%03d', $order + 1);
    
        
        return view('inventaris_report.create', compact('reportDate', 'token'));
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
        //
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
