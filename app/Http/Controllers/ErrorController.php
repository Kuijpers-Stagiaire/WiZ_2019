<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notauthorized()
    {
        return view('errors.401');
    }
    public function forbidden()
    {
        return response(view('errors.403'), 403);
    }
    public function notfound()
    {
        return view('errors.404');
    }
    public function sessionexpired()
    {
        return view('errors.419');
    }
    public function serverrequest()
    {
        return view('errors.429');
    }
    public function fatal()
    {
        return view('errors.500');
    }
    public function maintenance()
    {
        return response(view('errors.503'), 503);
    }
}
