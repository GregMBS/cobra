<?php

namespace App\Http\Controllers;

use App\PagosClass;
use Illuminate\Support\Facades\View;

class PagosController extends Controller
{
    /**
     *
     * @var PagosClass
     */
    private $pc;

    public function __construct() {
        $this->pc = new PagosClass();
    }
    
    /**
     * 
     * @param int $id_cuenta
     * @return View
     */
    public function showOne($id_cuenta) {
        $cuentaCliente = $this->pc->getCuentaClienteFromID($id_cuenta);
        $cuenta = $cuentaCliente['cuenta'];
        $cliente = $cuentaCliente['cliente'];
        $pagos = $this->pc->listPagos($id_cuenta);
        $view = view('pagos')
        ->with('cuenta', $cuenta)
        ->with('cliente', $cliente)
        ->with('pagos', $pagos);
        return $view;
    }
}
