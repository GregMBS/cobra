<?php

namespace App\Http\Controllers;

use View;
use App\AgentActivityClass;

class AgentActivityController extends Controller
{
    /** @var AgentActivityClass  */
    protected $dc;

    /** @var string  */
    protected $promiseView = 'pdh';

    /** @var string  */
    protected $callView = 'ddh';

    public function __construct() {
        $this->dc = new AgentActivityClass();
    }
    
    /**
     * 
     * @param string $agent
     * @param string $date
     * @return View
     */
    public function promises($agent, $date)
    {
        $result = $this->dc->getPromises($agent, $date);
        $view = view($this->promiseView)
        ->with('gestor', $agent)
        ->with('fecha', $date)
        ->with('results', $result);
        return $view;
    }
    
    /**
     *
     * @param string $agent
     * @param string $date
     * @return View
     */
    public function calls($agent, $date)
    {
        $result = $this->dc->getCalls($agent, $date);
        $view = view($this->callView)
        ->with('gestor', $agent)
        ->with('fecha', $date)
        ->with('results', $result);
        return $view;
    }
    
}
