<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    public function edit()
    {
       $user =  Auth::guard('cms')->user();

        return view('admin.profile.edit', compact('user'));

    }//End Method

    public function update(ProfileRequest $request)
    {
        Auth::guard('cms')->user()->update($request->validated());

        return redirect()->back()->with('success', 'Profile Updated.');

    }//End Method
}
