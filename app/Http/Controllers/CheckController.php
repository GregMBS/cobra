<?php

namespace App\Http\Controllers;

use App\CheckClass;
use App\UserClass;
use Illuminate\Http\Request;
use View;

class CheckController extends Controller
{
    /**
     *
     * @var CheckClass
     */
    private $cc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    public function __construct() {
        $this->cc = new CheckClass();
        $this->uc = new UserClass();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function assign(Request $r) {
        $data = collect($r->all());
        $this->cc->insertVisitorAssignment($data);
        $list = $this->cc->listVisitorAssignment($r->gestor);
        $view = $this->checkout($list, $r->gestor, $r->tipo);
        return $view;
    }
    
    /**
     *
     * @param Request $r
     * @return View
     */
    public function assignBoth(Request $r) {
        $data = collect($r->all());
        $this->cc->insertVisitorAssignmentBoth($data);
        $list = $this->cc->listVisitorAssignment($r->gestor);
        $view = $this->checkBoth($list, $r->gestor, $r->tipo, $r->fechaout);
        return $view;
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function receive(Request $r) {
        $data = collect($r->all());
        $this->cc->updateVisitorAssignment($data);
        $list = $this->cc->listVisitorAssignment($r->gestor);
        $view = $this->checkIn($list, $r->gestor, $r->tipo);
        return $view;
    }

    /**
     * @param string $agent
     * @return mixed
     * @throws \Exception
     */
    public function listing($agent) {
        $visitor = $this->cc->getFullName($agent);
        $capt = $this->cc->getFullName(auth()->user()->iniciales);
        $list = $this->cc->listVisitorAssignment($agent);
        $accounts = count($list);
        $balances = array_sum(array_column($list, 'saldo_total'));
        /**
         * @var View $view
         * @method static|View with(string $label, mixed $value)
         */
        $view = view('checkOutList');
        $view = $view->with('visitador', $visitor)
        ->with('capt', $capt)
        ->with('list', $list)
        ->with('cuentas', $accounts)
        ->with('saldos', $balances);
        return $view;
    }   
    
    /**
     * 
     * @param string $agent
     * @return View
     */
    public function checkoutAjax($agent) {
        $list = $this->cc->listVisitorAssignment($agent);
        return $this->checkout($list, $agent);
    }
    
    /**
     * 
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @return View
     */
    public function checkout(array $list = [], $agent = '', $tipo = '') {
        $agents = $this->uc->getVisitors();
        $counts = $this->cc->countInOut($agent);
        $view = view('checkout')
        ->with('gestor', $agent)
        ->with('gestores', $agents)
        ->with('tipo', $tipo)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }
    
    /**
     *
     * @param string $agent
     * @return View
     */
    public function checkInAjax($agent) {
        $list = $this->cc->listVisitorAssignment($agent);
        return $this->checkin($list, $agent);
    }
    
    /**
     *
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @return View
     */
    public function checkIn(array $list = [], $agent = '', $tipo = '') {
        $agents = $this->uc->getVisitors();
        $counts = $this->cc->countInOut($agent);
        $view = view('checkIn')
        ->with('gestor', $agent)
        ->with('gestores', $agents)
        ->with('tipo', $tipo)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }
    
    /**
     *
     * @param string $agent
     * @return View
     */
    public function checkBothAjax($agent) {
        $list = $this->cc->listVisitorAssignment($agent);
        return $this->checkBoth($list, $agent);
    }
    
    /**
     * 
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @param string $dateOut
     * @return View
     */
    public function checkBoth(array $list = [], $agent = '', $tipo = '', $dateOut = '') {
        $agents = $this->uc->getVisitors();
        $counts = $this->cc->countInOut($agent);
        /** @var View $view */
        $view = view('checkBoth')
        ->with('gestor', $agent)
        ->with('gestores', $agents)
        ->with('tipo', $tipo)
        ->with('fechaOut', $dateOut)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }

}
