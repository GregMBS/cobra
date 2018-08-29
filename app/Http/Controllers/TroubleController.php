<?php

namespace App\Http\Controllers;

use App\TroubleClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class TroubleController extends Controller
{
    
    /**
     *
     * @var TroubleClass
     */
    private $tc;
    
    
    public function __construct() {
        $this->tc = new TroubleClass();
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trouble = $this->tc->listTrouble();
        return view('troubleAdmin')->with('trouble', $trouble);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('trouble');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $r
     * @return Redirect
     */
    public function store(Request $r)
    {
        $capt = auth()->user()->iniciales;
        $this->tc->insertTrouble($r->sistema, $capt, $r->fuente, $r->descripcion, $r->error_msg);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->index();
    }
}
