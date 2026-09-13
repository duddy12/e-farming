<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request){

        $request->validate([

            'user_name' => 'required',
            'password' =>'required',

        ]);
        $user = User::where('user_name',$request->user_name)->first();
        if (!$user) {
            return back()->with('error', 'Username atau password salah.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah.');
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}