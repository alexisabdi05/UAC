<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function create()
    {
        $registrationPrice = rand(100000, 125000);
        return view('register', compact('registrationPrice'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'gender' => 'required',
            'hobbies' => 'required|array|min:3',
            'hobbies.*' => 'string|max:255',
            'instagram_username' => 'required|url',
            'mobile_number' => 'required|digits_between:10,15',
            'casual_friends' => 'required|boolean',
            'registration_price' => 'required|integer|between:100000,125000',
        ]);
    
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'gender' => $request->gender,
            'hobbies' => implode(', ', $request->hobbies),
            'instagram_username' => $request->instagram_username,
            'mobile_number' => $request->mobile_number,
            'casual_friends' => $request->has('casual_friends'),
            'registration_price' => $request->registration_price,
            'profile_picture_url' => 'default.png',
        ]);

        $user->save();
        Auth::login($user);

        return redirect('/show-price')->with('registerSuccess', 'You success register');
    }

    public function login(Request $request){
        $validate = $request->validate([
            'password' => 'required',
            'email' => 'required'
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect()->back()->with('loginError', 'Login Failed!');
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
};
