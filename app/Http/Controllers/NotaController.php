<?php

namespace App\Http\Controllers;

use App\NotaClass;
use App\ResumenClass;
use App\UserClass;
use Illuminate\Http\Request;
use View;

class NotaController extends Controller
{
    /**
     *
     * @var NotaClass
     */
    private $nc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    /**
     *
     * @var ResumenClass
     */
    private $rc;

    public function __construct()
    {
        $this->nc = new NotaClass();
        $this->uc = new UserClass();
        $this->rc = new ResumenClass();
    }

    /**
     *
     * @param int $id_cuenta
     * @return View
     */
    public function index($id_cuenta = 0)
    {
        $cuenta = $this->rc->getCuentaFromId($id_cuenta);
        $capt = auth()->user()->iniciales;
        $notas = $this->nc->listMyNotas($capt);
        $view = view('notas')
            ->with('id_cuenta', $id_cuenta)
            ->with('cuenta', $cuenta)
            ->with('capt', $capt)
            ->with('notas', $notas);
        return $view;
    }

    /**
     *
     * @param int $id_cuenta
     * @return View
     */
    public function indexAdmin($id_cuenta = 0)
    {
        $cuenta = $this->rc->getCuentaFromId($id_cuenta);
        $notas = $this->nc->listAllNotas();
        $gestores = $this->uc->listUsers();
        $view = view('notadmin')
            ->with('gestores', $gestores)
            ->with('cuenta', $cuenta)
            ->with('notas', $notas);
        return $view;
    }

    /**
     *
     * @param int $nota_id
     * @return View
     */
    public function remove($nota_id)
    {
        $capt = auth()->user()->iniciales;
        $this->nc->softDeleteOneNota($capt, $nota_id);
        return $this->index();
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function add(Request $r)
    {
        $capt = auth()->user()->iniciales;
        $D_FECH = date('Y-m-d');
        $C_HORA = date('H:i:s');
        $C_CONT = $r->C_CONT;
        $cuenta = $this->rc->getCuentaFromId($C_CONT);
        $FECHA = $r->fecha;
        $HORA = $r->hora . ':' . $r->min;
        $NOTA = $r->nota;
        $id_cuenta = $this->nc->insertNota($capt, $D_FECH, $C_HORA, $FECHA, $HORA, $NOTA, $cuenta, $C_CONT);
        return $this->index($id_cuenta);
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function addAdmin(Request $r)
    {
        $capt = auth()->user()->iniciales;
        $C_CONT = $r->C_CONT;
        $FECHA = $r->fecha;
        $HORA = $r->hora . ':' . $r->min;
        $NOTA = $r->nota;
        $target = $r->target;
        $this->nc->insertNotaAdmin($target, $capt, $FECHA, $HORA, $NOTA);
        return $this->indexAdmin($C_CONT);
    }
}
