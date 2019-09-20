<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index()
    {
        return view('auth/index');
    }

    public function register()
    {
        return view('auth/Register');
    }

    public function overons()
    {
        return view('overons');
    }

}
