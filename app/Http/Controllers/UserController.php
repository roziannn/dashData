<?php

namespace App\Http\Controllers;

use App\Models\User;
use CreateAuditsTable;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select("SELECT * FROM users order by first_name asc");

        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $autoname = 'dash.';
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedDate = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'nip' => 'required',
            'roles' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $validatedDate['password'] = Hash::make($validatedDate['password']);

        User::create($validatedDate);
        $request->accepts('session');

        session()->flash('success', 'User create has been success!');

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
        $data = User::find($id);

        // $audits = ModelsAudit::find($id);
        // $audits = DB::table('audits')->where('auditable_type', User::find($id))->get();
        // $audits = ModelsAudit::find($id)->where('auditable_type', User::class)->get();

        $audits = User::find($id)->audits;

        return view('user.show', compact('data', 'audits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('user.edit', compact('data'));
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
        User::find($id)->update([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'nip'=> $request->nip,
            'roles'=> $request->roles,
            'email'=> $request->email,
        ]);

        $request->accepts('session');
        session()->flash('success', 'Berhasil mengubah data pegawai!');

        return redirect()->back();
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('/user/index')->with('successDelete', 'User has been deleted!');
    }
}
