<?php

namespace App\Http\Controllers;

use App\BuscarClass;
use App\ChangestClass;
use Illuminate\Http\Request;
use View;

class ChangestController extends Controller
{
    /**
     *
     * @var ChangestClass
     */
    private $cc;
    
    public function __construct() {
        $this->cc = new ChangestClass();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function showOne(Request $r) {
        $field = $r->field; 
        $find = $r->find;
        $from = $r->path();
        $cliente = $r->cliente;
        $view = $this->returnView($field, $find, $from, $cliente);
        return $view;
    }
    
    public function updateOne(Request $r) {
        $field     = 'id_cuenta';
        $find      = $r->C_CONT;
        $from = $r->path();
        $inactivo = $r->has('inactivo');
        $this->cc->updateResumen($inactivo, $find);
        $view = $this->returnView($field, $find, $from, '');
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
        $result = [];
        $bc = new BuscarClass();
        if (!empty($find)) {
            $result = $bc->searchAccounts($field, $find, $cliente);
        }
        $clienteList = $bc->listClients();
        $view = view('changest')
        ->with('field', $field)
        ->with('find', $find)
        ->with('from', $from)
        ->with('result', $result)
        ->with('resultcl', $clienteList);
        return $view;
    }
}
