<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function index() {
        return view('homepage');
    }

    public function emailConfirm() {
        return view('confirm-email');
    }
}
