<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
     public function about()
    {
        return view('about'); // resources/views/about.blade.php
    }
}
