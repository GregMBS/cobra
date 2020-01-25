<?php

namespace App\Http\Controllers;

use View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View |\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
