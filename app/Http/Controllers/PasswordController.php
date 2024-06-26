<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class PasswordController extends Controller
{
    public function index()
    {
        return view('changePassword.index');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);

        $request->accepts('session');
        session()->flash('success', 'Password has been update!');
    
        return view('changePassword.index');
    }
}
