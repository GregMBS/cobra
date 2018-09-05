<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BuscarClass;
use View;

class BuscarController extends Controller
{
    /**
     *
     * @var BuscarClass
     */
    private $bc;
    
     public function __construct() {
        $this->bc = new BuscarClass();
    }
    
    /**
     * 
     * @param Request $r
     * @return View
     */
    public function search(Request $r) {
        $field = $r->field; 
        $find = $r->find;
        $from = $r->path();
        $cliente = $r->cliente;
        if (!empty($find)) {
            $view = $this->returnView($field, $find, $from, $cliente);
        } else {
            $clienteList = $this->bc->listClients();
            $view = view('buscar')->with('resultcl', $clienteList);
        }
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
        $result = $this->bc->searchAccounts($field, $find, $cliente);
        $clienteList = $this->bc->listClients();
        /**
         * @var \Illuminate\View\View
         */
        $baseView = view('buscar');
        $view = $baseView
        ->with('field', $field)
        ->with('find', $find)
        ->with('from', $from)
        ->with('capt', auth()->user()->iniciales)
        ->with('result', $result)
        ->with('resultcl', $clienteList);
        return $view;
    }
}
