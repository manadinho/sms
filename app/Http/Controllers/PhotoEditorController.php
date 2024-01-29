<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoEditorController extends Controller
{
    public function index()
    {
        return view('photoeditor.index');
    }
}
