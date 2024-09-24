<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(){

    }
}
