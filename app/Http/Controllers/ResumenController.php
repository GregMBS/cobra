<?php
namespace App\Http\Controllers;

use App\ResumenClass;
use App\ResumenQueuesClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\GestionClass;
use Illuminate\Support\Facades\View;

class ResumenController extends Controller
{

    /**
     *
     * @var ResumenClass
     */
    private $rc;

    /**
     *
     * @var ResumenQueuesClass
     */
    private $rqc;

    /**
     *
     * @var GestionClass
     */
    private $gc;

    public function __construct()
    {
        $this->rc = new ResumenClass();
        $this->gc = new GestionClass();
        $this->rqc = new ResumenQueuesClass();
    }

    /*
    private function getFields(Request $r)
    {
        $tl = date('r');
        $tipo = auth()->user()->tipo;
        $findo = $r->find;
        $field = $r->field;
        $find = $this->rc->cleanFind($findo);
        $notas = $this->rc->notAlert($capt);
    }
    */

    /**
     *
     * @return View
     */
    public function ultima()
    {
        $capt = auth()->user()->capt;
        $id_cuenta = $this->rc->lastGestion($capt);
        $result = $this->rqc->getOne($id_cuenta);
        $history = $this->rc->getHistory($id_cuenta);
        $from = 'ultima';
        $view = view('resumen')
        ->with('r', $result)
        ->with('history', $history)
        ->with('from', $from);
        return $view;
    }
    
    /**
     * 
     * @param int $id_cuenta
     * @return View
     */
    public function find($id_cuenta)
    {
        $result = $this->rqc->getOne($id_cuenta);
        $history = $this->rc->getHistory($id_cuenta);
        $from = 'find';
        $view = view('resumen')
        ->with('r', $result)
        ->with('history', $history)
        ->with('from', $from);
        return $view;
    }

/**
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        return redirect('logout');
    }

    /**
     *
     * @param Request $r
     */
    public function capture(Request $r)
    {
        if (($r->has('C_CVST') && ($r->has('C_VISIT')))) {
            $gestion = $r->all();
            $this->gc->doVisit($gestion);
        }
        $view = $this->ultima();
        return $view;
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function addNew(Request $r)
    {
        $this->gc->addNewTel($r->C_CONT, $r->C_NTEL);
        $this->gc->addNewTel($r->C_CONT, $r->C_OBSE2);
        $this->gc->updateAddress($r->C_CONT, $r->C_NDIR);
        $view = $this->ultima();
        return $view;
    }

    /**
     * 
     * @param Request $r
     * @return View
     */
    public function gestion(Request $r)
    {
        if (($r->has('C_CVST') && ($r->has('C_CVGE')))) {
            $gestion = $r->all();
            $this->gc->doGestion($gestion);
        }
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @return View
     */
    public function index()
    {
        $capt = auth()->user()->capt;
        $camp = auth()->user()->camp;
        $result = $this->rqc->getResumen($capt, $camp);
        $id_cuenta = $result['id_cuenta'];
        $history = $this->rc->getHistory($id_cuenta);
        $view = view('resumen')
        ->with('r', $result)
        ->with('history', $history);
        return $view;
    }
}