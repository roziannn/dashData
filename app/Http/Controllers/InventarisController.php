<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Inventaris;
use App\Models\InventarisCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return redirect('/inventaris')->with('successDelete', 'Item has been deleted!');
    }

    public function category($id){

        $dataItem = Inventaris::all();
        $dataDepartment = Department::all();
        
        $dataCategory = DB::select("SELECT * FROM inventaris_categories");

        
        return view('/inventaris.index', compact('dataCategory', 'dataItem', 'dataDepartment'));
    }
}
