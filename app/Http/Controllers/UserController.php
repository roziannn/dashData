<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

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
        User::where('id', $id)->update([
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();

        return redirect('/user/index')->with('successDelete', 'User has been deleted!');
    }
}
