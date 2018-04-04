<?php

namespace App\Http\Controllers;

use App\CheckClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CheckController extends Controller
{
    /**
     *
     * @var CheckClass
     */
    private $cc;
    
    public function __construct() {
        $this->cc = new CheckClass();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function assign(Request $r) {
        $this->cc->setVars($r);
        $this->cc->insertVasign();
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
        $this->cc->setVars($r);
        $this->cc->insertVasignBoth();
        $list = $this->cc->listVasign($r->gestor);
        $view = $this->checkboth($list, $r->gestor, $r->tipo, $r->fechaout);
        return $view;
    }
    
    /**
     * 
     * @param string $gestor
     * @return View
     */
    public function listing($gestor) {
        $visitador = $this->cc->getCompleto($gestor);
        $capt = $this->cc->getCompleto(auth()->user()->iniciales);
        $list = $this->cc->listVasign($gestor);
        $cuentas = count($list);
        $saldos = array_sum(array_column($list, 'saldo_total'));
        $view = view('checkoutlist')
        ->with('visitador', $visitador)
        ->with('capt', $capt)
        ->with('list', $list)
        ->with('cuentas', $cuentas)
        ->with('saldos', $saldos);
        return $view;
    }
    
    /**
     * 
     * @param array $list
     * @param string $gestor
     * @param string $tipo
     * @return View
     */
    public function checkout(array $list = [], $gestor = '', $tipo = '') {
        $gestores = $this->cc->getVisitadores();
        $view = view('checkout')
        ->with('gestor', $gestor)
        ->with('gestores', $gestores)
        ->with('tipo', $tipo)
        ->with('list', $list);
        return $view;
    }

    /**
     * 
     * @param array $list
     * @param string $gestor
     * @param string $tipo
     * @param string $fechaout
     * @return View
     */
    public function checkboth(array $list = [], $gestor = '', $tipo = '', $fechaout = '') {
        $gestores = $this->cc->getVisitadores();
        $view = view('checkout')
        ->with('gestor', $gestor)
        ->with('gestores', $gestores)
        ->with('tipo', $tipo)
        ->with('fechaout', $fechaout)
        ->with('list', $list);
        return $view;
    }
    
}
