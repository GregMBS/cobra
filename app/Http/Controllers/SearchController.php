<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SearchClass;
use View;

class SearchController extends Controller
{
    /**
     *
     * @var SearchClass
     */
    private $bc;
    
     public function __construct() {
        $this->bc = new SearchClass();
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
        if (empty($cliente)) {
            $cliente = '';
        }
        $clienteList = $this->bc->listClients();
        $view = view('buscar')->with('resultcl', $clienteList);
        if (!empty($find)) {
            $view = $this->returnView($field, $find, $from, $cliente);
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
    private function returnView($field, $find, $from, string $cliente = '') {
        $result = $this->bc->searchAccounts($field, $find, $cliente);
        $clienteList = $this->bc->listClients();
        /**
         * @var View $view
         */
        $view = view('buscar')->with('field', $field);
        $view = $view->with('find', $find);
        $view = $view->with('from', $from);
        $view = $view->with('capt', auth()->user()->iniciales);
        $view = $view->with('result', $result);
        $view = $view->with('resultcl', $clienteList);
        return $view;
    }
}
