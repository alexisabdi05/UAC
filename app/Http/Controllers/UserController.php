<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function show(Request $request, User $user)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    return view('user.show', compact('user'));
}

    public function topup(Request $request){
        $user = User::find(auth()->user()->id);
        $user->wallet = $user->wallet + $request->wallet;
        $user->update();
        return redirect('/buyer');
    }
}
