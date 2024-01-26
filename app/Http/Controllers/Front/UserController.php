<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;


class UserController extends Controller
{
    
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->get();
        $reviews = $user->reviews()->latest()->get();

        return view('front.user.index', compact('orders', 'reviews', 'user'));

    }//End Method

    public function update(ProfileRequest $request)
    {
        Auth::user()->update($request->validated());

        return redirect()->back()->withSuccess('Profile Updated.');

    }//End Method

    public function password(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|current_password:web',
            'password'     => 'required|confirmed|min:6',
        ], [
            'old_password.current_password' => 'The old password is incorrect.',
        ]);

        Auth::user()->update($validated);

        return redirect()->back()->with('success', 'Password Changed.');

    }//End Method
}
