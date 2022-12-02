<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Inventaris;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Models\LogsInventary;
use App\Models\InventarisCategory;
use Illuminate\Support\Facades\DB;
use App\Models\LogInventaryActivity;
use App\Models\LogsCommentInventary;
use Illuminate\Support\Facades\Auth;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategory = DB::table('inventaris_categories')->orderBy('inventarisCategory_name', 'asc')->get();

        $dataItem = Inventaris::all();
        
        $dataDepartment = Department::all();
        $dataCategory = InventarisCategory::all();    

        return view('inventaris.index', compact('dataCategory', 'dataItem', 'dataDepartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        inventaris::create($request->all());

        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        LogsInventary::record(Auth::user(), Auth::user()->first_name,  ' added ', $request->code . ' to ', $request->inventarisCategory_name);

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
        //
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
        Inventaris::where('id', $id)->update([
            'code'=> $request->code,
            'brand'=> $request->brand,
            'inventarisCategory_name'=> $request->inventarisCategory_name,
            'reg_code'=> $request->reg_code,
            'year'=> $request->year,
            'condition'=> $request->condition,
            'location'=> $request->location,
            'department'=> $request->department,
            'used_by'=> $request->used_by,
            'others'=> $request->others,
        ]);

        LogsInventary::record(Auth::user(), Auth::user()->first_name,  ' edited ', $request->code . ' in ', $request->inventarisCategory_name);

        LogsCommentInventary::record(Auth::user(), $request->id, Auth::user()->first_name, ' was update ', $request->code)->where('id', $id);

        $request->accepts('session');
        session()->flash('successUpdate', 'Item has been updated!');

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
        $data = Inventaris::find($id);
        $data->delete();

        LogsInventary::record(Auth::user(), Auth::user()->first_name, ' delete ', $data->code . ' on', $data->inventarisCategory_name);

        return redirect('/inventaris')->with('successDelete', 'Item has been deleted!');
    }

    public function category($id){

        $dataItem = Inventaris::all();
        $dataDepartment = Department::all();
        
        $dataCategory = DB::select("SELECT * FROM inventaris_categories");

        
        return view('/inventaris.index', compact('dataCategory', 'dataItem', 'dataDepartment'));
    }

    public function activity_log(){

        $data = DB::select("SELECT * FROM logs_inventary");

    return view('inventaris.activityLog.index', compact('data'));
    }
}
