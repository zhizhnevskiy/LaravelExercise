<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        /**
         * Just return view with form
         */
        return view('home');
    }
}
