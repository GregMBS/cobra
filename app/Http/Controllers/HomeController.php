<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * 
     * @var string[]
     */
    protected $enlaces = [
        'admin' => 'reports',
        'callcenter' => 'resumen',
        'visitador' => 'resumen'
    ];
    
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = auth()->user()->tipo;
        $enlace = '/';
        if (isset($this->enlaces[$tipo])) {
            $enlace = $this->enlaces[$tipo];
        }
        return redirect($enlace);
    }
}
