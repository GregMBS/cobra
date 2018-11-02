<?php

namespace App\Http\Controllers;

use App\VisitorActivityClass;

class VisitorActivityController extends AgentActivityController
{
    /** @var VisitorActivityClass  */
    protected $dc;

    /** @var string  */
    protected $promiseView = 'pdhv';

    /** @var string  */
    protected $callView = 'ddhv';
    
    public function __construct() {
        parent::__construct();
        $this->dc = new VisitorActivityClass();
    }

}
