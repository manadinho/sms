<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserController extends Controller
{
    public function store(Request $request)
    {
       $requ = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
      $user =  User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        Auth::login($user);
        return redirect('/')->with('User Register Successfully');
    }
    // Method for handling user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
        }
    }
}

