<?php
namespace App\Http\Controllers;

use App\ResumenClass;
use App\ResumenQueuesClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\GestionClass;
use Illuminate\Support\Facades\View;
use App\NotaClass;

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
    
    /**
     * 
     * @var NotaClass
     */
    private $nc;

    public function __construct()
    {
        $this->rc = new ResumenClass();
        $this->gc = new GestionClass();
        $this->rqc = new ResumenQueuesClass();
        $this->nc = new NotaClass();
    }

    /*
    private function getFields(Request $r)
    {
        $tl = date('r');
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
        $view = $this->buildView($result, $history, $from, $capt);
        return $view;
    }
    
    /**
     * 
     * @param int $id_cuenta
     * @return View
     */
    public function find($id_cuenta)
    {
        $capt = auth()->user()->capt;
        $result = $this->rqc->getOne($id_cuenta);
        $history = $this->rc->getHistory($id_cuenta);
        $from = 'find';
        $view = $this->buildView($result, $history, $from, $capt);
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
            $valid = $this->gc->doVisit($gestion);
        }
        $view = $this->ultima()->with('valid', $valid);
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
            $valid = $this->gc->doGestion($gestion);
        }
        $view = $this->index()->with('valid', $valid);
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
        $from = '';
        $view = $this->buildView($result, $history, $from, $capt);
        return $view;
    }
    
    /**
     * 
     * @param array $result
     * @param array $history
     * @param string $from
     * @param string $capt
     * @return View
     */
    private function buildView($result, $history, $from, $capt) {
        $id_cuenta = $result['id_cuenta'];
        $numgest = $this->rc->getNumGests($capt);
        $tl = $this->rc->getTimelock($id_cuenta);
        $notas = $this->nc->notAlert($capt);
        $view = view('resumen')
        ->with('user', auth()->user())
        ->with('r', $result)
        ->with('history', $history)
        ->with('notas', $notas)
        ->with('capt', $capt)
        ->with('tipo', auth()->user()->tipo)
        ->with('tl', $tl)
        ->with('numgest', $numgest)
        ->with('from', $from);
        return $view;
    }
}