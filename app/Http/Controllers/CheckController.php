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
        $this->cc->insertVasign($data);
        $list = $this->cc->listVasign($r->gestor);
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
        $this->cc->insertVasignBoth($data);
        $list = $this->cc->listVasign($r->gestor);
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
        $this->cc->updateVasign($data);
        $list = $this->cc->listVasign($r->gestor);
        $view = $this->checkIn($list, $r->gestor, $r->tipo);
        return $view;
    }

    /**
     * @param string $gestor
     * @return mixed
     * @throws \Exception
     */
    public function listing($gestor) {
        $visitador = $this->cc->getCompleto($gestor);
        $capt = $this->cc->getCompleto(auth()->user()->iniciales);
        $list = $this->cc->listVasign($gestor);
        $cuentas = count($list);
        $saldos = array_sum(array_column($list, 'saldo_total'));
        /**
         * @var View $view
         * @method static View with(string $label, mixed $value)
         */
        $view = view('checkOutList')
        ->with('visitador', $visitador)
        ->with('capt', $capt)
        ->with('list', $list)
        ->with('cuentas', $cuentas)
        ->with('saldos', $saldos);
        return $view;
    }   
    
    /**
     * 
     * @param string $gestor
     * @return View
     */
    public function checkoutAjax($gestor) {
        $list = $this->cc->listVasign($gestor);
        return $this->checkout($list, $gestor);
    }
    
    /**
     * 
     * @param array $list
     * @param string $gestor
     * @param string $tipo
     * @return View
     */
    public function checkout(array $list = [], $gestor = '', $tipo = '') {
        $gestores = $this->uc->getVisitadores();
        $counts = $this->cc->countInOut($gestor);
        $view = view('checkout')
        ->with('gestor', $gestor)
        ->with('gestores', $gestores)
        ->with('tipo', $tipo)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }
    
    /**
     *
     * @param string $gestor
     * @return View
     */
    public function checkInAjax($gestor) {
        $list = $this->cc->listVasign($gestor);
        return $this->checkin($list, $gestor);
    }
    
    /**
     *
     * @param array $list
     * @param string $gestor
     * @param string $tipo
     * @return View
     */
    public function checkIn(array $list = [], $gestor = '', $tipo = '') {
        $gestores = $this->uc->getVisitadores();
        $counts = $this->cc->countInOut($gestor);
        $view = view('checkIn')
        ->with('gestor', $gestor)
        ->with('gestores', $gestores)
        ->with('tipo', $tipo)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }
    
    /**
     *
     * @param string $gestor
     * @return View
     */
    public function checkBothAjax($gestor) {
        $list = $this->cc->listVasign($gestor);
        return $this->checkBoth($list, $gestor);
    }
    
    /**
     * 
     * @param array $list
     * @param string $gestor
     * @param string $tipo
     * @param string $fechaOut
     * @return View
     */
    private function checkBoth(array $list = [], $gestor = '', $tipo = '', $fechaOut = '') {
        $gestores = $this->uc->getVisitadores();
        $counts = $this->cc->countInOut($gestor);
        $view = view('checkBoth')
        ->with('gestor', $gestor)
        ->with('gestores', $gestores)
        ->with('tipo', $tipo)
        ->with('fechaOut', $fechaOut)
        ->with('list', $list)
        ->with('counts', $counts);
        return $view;
    }

    /**
     *
     * @param string $gestor
     * @return string
     * @throws \Exception
     */
    public function getCompleto($gestor)
    {
        $completo = $this->cc->getCompleto($gestor);
        return $completo;
    }

}
