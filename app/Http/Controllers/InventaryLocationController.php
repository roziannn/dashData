<?php

namespace App\Http\Controllers;

use App\Models\InventaryLocation;
use Illuminate\Http\Request;

class InventaryLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InventaryLocation::all();
        return view('inventaris.location.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        InventaryLocation::create($request->all());
        
        $request->accepts('session');
        session()->flash('success', 'Berhasil menambahkan data!');

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = InventaryLocation::find($id);
        $data->delete();

        return redirect('/master/inventaris_location')->with('successDelete', 'Category has been deleted!');
    }
}
