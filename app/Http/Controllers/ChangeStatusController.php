<?php

namespace App\Http\Controllers;

use App\SearchClass;
use App\ChangeStatusClass;
use Illuminate\Http\Request;
use View;

class ChangeStatusController extends Controller
{
    /**
     *
     * @var ChangeStatusClass
     */
    private $cc;
    
    public function __construct() {
        $this->cc = new ChangeStatusClass();
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
        $client = $r->cliente;
        $view = $this->returnView($field, $find, $from, $client);
        return $view;
    }
    
    public function updateOne(Request $r) {
        $field     = 'id_cuenta';
        $find      = $r->C_CONT;
        $from = $r->path();
        $inactive = $r->has('inactivo');
        $this->cc->updateDebtor($inactive, $find);
        $view = $this->returnView($field, $find, $from, '');
        return $view;
    }
    
    /**
     * 
     * @param string $field
     * @param string $find
     * @param string $from
     * @param string $client
     * @return View
     */
    private function returnView($field, $find, $from, $client) {
        $result = [];
        $bc = new SearchClass();
        if (!empty($find)) {
            $result = $bc->searchAccounts($field, $find, $client);
        }
        $clientList = $bc->listClients();
        /** @var View $view */
        $view = view('changest');
        $view = $view->with('field', $field);
        $view = $view->with('find', $find);
        $view = $view->with('from', $from);
        $view = $view->with('result', $result);
        $view = $view->with('resultcl', $clientList);
        return $view;
    }
}
