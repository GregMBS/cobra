<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\BuscarClass;

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
        $id_cuenta = $r->C_CONT;
        $view = $this->returnView($field, $find, $from, $cliente, $id_cuenta);
        return $view;
    }
    
    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $from
     * @param string $cliente
     * @param int $id_cuenta
     * @return View
     */
    private function returnView($field, $find, $from, $cliente, $id_cuenta) {
        $result = $this->bc->searchAccounts($field, $find, $cliente);
        $clienteList = $this->bc->listClients();
        $view = view('buscar')
        ->with('field', $field)
        ->with('find', $find)
        ->with('from', $from)
        ->with('capt', auth()->user()->capt)
        ->with('C_CONT', $id_cuenta)
        ->with('result', $result)
        ->with('resultcl', $clienteList);
        return $view;
    }
}
