<?php

namespace App\Http\Controllers;


use App\NombresadminClass;

class NombresadminController extends GestoradminController
{

    public function __construct()
    {
        parent::__construct();
        $this->gc = new NombresadminClass();
    }

}