<?php

namespace App\Http\Controllers;


use App\OldNamesAdminClass;

class NombresadminController extends GestoradminController
{

    public function __construct()
    {
        parent::__construct();
        $this->gc = new OldNamesAdminClass();
    }

}