<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('emails.home');
    }
    public function ecommerce() {
        return view('ecommerce');
    }
}
