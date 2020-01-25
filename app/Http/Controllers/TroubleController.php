<?php

namespace App\Http\Controllers;

use App\TroubleClass;
use App\TroubleDataClass;
use Illuminate\Http\Request;
use View;

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
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $trouble = $this->tc->listTrouble();
        return view('troubleAdmin')->with('trouble', $trouble);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|\Illuminate\View\View
     */
    public function create()
    {
        return view('trouble');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $r
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $r)
    {
        $capt = auth()->user()->iniciales;
        $tdc = new TroubleDataClass();
        $tdc->system = $r->system;
        $tdc->user = $capt;
        $tdc->source = $r->source;
        $tdc->description = $r->description;
        $tdc->error_msg = $r->error_msg;
        $this->tc->insertTrouble($tdc);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function show($id)
    {
        return $this->index();
    }
    */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function edit($id)
    {
        return $this->index();
    }
    */

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function update(Request $request, $id)
    {
        $capt = auth()->user()->iniciales;
        $tdc = new TroubleDataClass();
        $tdc->auto = $id;
        $tdc->user = $capt;
        $tdc->fix = $request->reparacion;
        $this->tc->updateTrouble($tdc, $capt);
        return redirect('/');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*
    public function destroy($id)
    {
        return $this->index();
    }
    */
}
