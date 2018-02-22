<?php

namespace App\Http\Controllers;

use App\PagosClass;
use App\PdoClass;
use Illuminate\Support\Facades\View;

class PagosController extends Controller
{
    /**
     *
     * @var PagosClass
     */
    private $pc;
    
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
        $this->pdo = $this->pdoc->dbConnectUser();
        $this->pc = new PagosClass($this->pdo);
        $this->capt = $this->pdoc->capt;
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
