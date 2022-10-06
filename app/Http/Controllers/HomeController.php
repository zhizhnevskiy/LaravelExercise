<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function home()
    {
        /**
         * Just return view with form
         */
        return view('home');
    }
}
