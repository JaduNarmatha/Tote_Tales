<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function visitor()
    {
        Session::put('role', 'visitor');
        return redirect()->route('about');
    }
}
