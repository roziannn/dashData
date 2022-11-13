<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        return view('profile.index', [
            'user' => $request->user()
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );

        $request->accepts('session');
        session()->flash('success', 'Data has been edited!');
        
        return redirect()->route('profile.index');
    }
}
