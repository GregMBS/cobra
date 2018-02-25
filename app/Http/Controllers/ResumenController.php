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
        $view = view('resumen')->with('field', 'id_cuenta')->with('find', $id_cuenta);
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
        $resumen = $this->rqc->getResumen($capt, $camp);
        $view = view('resumen')->with('r', $resumen);
        return $view;
    }
}