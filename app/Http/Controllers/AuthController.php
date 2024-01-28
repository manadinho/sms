<?php

namespace App\Http\Controllers;

use App\Mail\SigninMagicLinkEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;use App\Models\User;
use App\Models\LoginMagicLinkToken;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function loginMagicLink(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::updateOrCreate(['email' => $request->email], ['email' => $request->email, 'name' => ' ']);

        LoginMagicLinkToken::where('user_id', $user->id)->delete();

        $token = \Str::random(60);

        $loginMagicToken = LoginMagicLinkToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'expires_at' => now()->addMinutes(10)
        ]);

        $link = route('auth.magic-link-token', ['token' => $token]);

        Mail::to($request->email)->send(new SigninMagicLinkEmail($request->email, $link));

        session(['magic_link_email' => $request->email]);

        return redirect()->route('auth.check-email');
    }

    public function loginWithToken($token)
    {
        $loginToken = LoginMagicLinkToken::where('token', hash('sha256', $token))
                                ->where('expires_at', '>', now())
                                ->firstOrFail();

        \Auth::loginUsingId($loginToken->user_id);

        $loginToken->delete();

        return redirect()->intended('welcome')->with('succus', 'Logged in successfully!');
    }

    public function register() {
        return view('auth.register');
    }

    public function checkEmail() {
        return view('auth.check-email');
    }
}
