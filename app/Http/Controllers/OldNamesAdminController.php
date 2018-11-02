<?php

namespace App\Http\Controllers;


use App\OldNamesAdminClass;

class OldNamesAdminController extends AgentAdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->gc = new OldNamesAdminClass();
    }

}