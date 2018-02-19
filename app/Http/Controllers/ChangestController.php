<?php

namespace App\Http\Controllers;

use App\ChangestClass;
use App\PdoClass;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ChangestController extends Controller
{
    /**
     *
     * @var ChangestClass
     */
    private $cc;
    
    /**
     *
     * @var PdoClass
     */
    private $pdoc;
    
    /**
     *
     * @var \PDO
     */
    private $pdo;
    
    /**
     * @var string
     */
    private $capt;
    
    public function __construct() {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectAdmin();
        $this->cc = new ChangestClass($this->pdo);
        $this->capt = $this->pdoc->capt;
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function showOne(Request $r) {
        $field = $r->field; 
        $find = $r->find;
        $from = $r->from;
        $cliente = $r->cliente;
        $view = $this->returnView($field, $find, $from, $cliente);
        return $view;
    }
    
    public function updateOne(Request $r) {
        $field     = 'id_cuenta';
        $find      = $r->C_CONT;
        $from = $r->from;
        $cliente = $r->cliente;
        $sdc = $r->sdc;
        $inactivo = $r->has('inactivo');
        $tags = $this->cc->getTags($sdc, $inactivo);
        $this->cc->updateResumen($tags, $find);
        $view = $this->returnView($field, $find, $from, $cliente);
        return $view;
    }
    
    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $from
     * @param string $cliente
     * @return View
     */
    private function returnView($field, $find, $from, $cliente) {
        $result = $this->cc->getReport($field, $find, $cliente);
        $clienteList = $this->cc->listClientes();
        $view = view('changest')
        ->with('fiels', $field)
        ->with('find', $find)
        ->with('from', $from)
        ->with('result', $result)
        ->with('resultcl', $clienteList);
        return $view;
    }
}
