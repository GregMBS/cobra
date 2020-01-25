<?php

namespace App\Http\Controllers;

use App\CheckClass;
use App\UserClass;
use Exception;
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
     * @throws Exception
     */
    public function assign(Request $r) {
        $data = collect($r->all());
        try {
            $this->cc->insertVasign($data);
        } catch (Exception $e) {
            throw $e;
        }
        $list = $this->cc->listVasign($r->gestor);
        $view = $this->checkout($list, $r->gestor, $r->tipo);
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws Exception
     */
    public function assignBoth(Request $r) {
        $data = collect($r->all());
        try {
            $this->cc->insertVasignBoth($data);
        } catch (Exception $e) {
            throw $e;
        }
        $list = $this->cc->listVasign($r->gestor);
        $view = $this->checkBoth($list, $r->gestor, $r->tipo, $r->fechaout);
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws Exception
     */
    public function receive(Request $r) {
        $data = collect($r->all());
        try {
            $this->cc->updateVasign($data);
        } catch (Exception $e) {
            throw $e;
        }
        $list = $this->cc->listVasign($r->gestor);
        $view = $this->checkIn($list, $r->gestor, $r->tipo);
        return $view;
    }

    /**
     * @param string $agent
     * @return mixed
     * @throws Exception
     */
    public function listing($agent) {
        $visitador = $this->cc->getCompleto($agent);
        $capt = $this->cc->getCompleto(auth()->user()->iniciales);
        $list = $this->cc->listVasign($agent);
        $accounts = count($list);
        $balances = array_sum(array_column($list, 'saldo_total'));
        /**
         * @var View $view
         * @method static|View with(string $label, mixed $value)
         */
        $view = view('checkOutList');
        $view = $view->with('visitador', $visitador)
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
        $list = $this->cc->listVasign($agent);
        return $this->checkout($list, $agent);
    }
    
    /**
     * 
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @return View|\Illuminate\View\View
     */
    public function checkout(array $list = [], $agent = '', $tipo = '') {
        $agents = $this->uc->getVisitadores();
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
        $list = $this->cc->listVasign($agent);
        return $this->checkin($list, $agent);
    }
    
    /**
     *
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @return View|\Illuminate\View\View
     */
    public function checkIn(array $list = [], $agent = '', $tipo = '') {
        $agents = $this->uc->getVisitadores();
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
        $list = $this->cc->listVasign($agent);
        return $this->checkBoth($list, $agent);
    }
    
    /**
     * 
     * @param array $list
     * @param string $agent
     * @param string $tipo
     * @param string $fechaOut
     * @return View
     */
    public function checkBoth(array $list = [], $agent = '', $tipo = '', $fechaOut = '') {
        $agents = $this->uc->getVisitadores();
        $counts = $this->cc->countInOut($agent);
        /** @var View $view */
        $view = view('checkBoth')
        ->with('gestor', $agent)
        ->with('gestores', $agents)
        ->with('tipo', $tipo)
        ->with('fechaOut', $fechaOut)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }

}
