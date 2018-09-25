<?php
namespace App\Http\Controllers;

use App\ResumenClass;
use App\ResumenQueuesClass;
use App\User;
use App\ValidationClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\GestionClass;
use Illuminate\Contracts\View\View;
use App\NotaClass;
use App\ReferenciaClass;
use Validator;

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
    
    /**
     * 
     * @var ReferenciaClass
     */
    private $fc;

    /**
     * @var array
     */
    private $gestionValidator = array(
        [
            'C_CVST' => 'required',
            'C_TELE' => 'required',
            'ACCION' => 'required',
            'C_OBSE1' => 'required|min:3|max:250'
        ]
    );

    /**
     * @var array
     */
    private $visitValidator = array(
        [
            'C_CVST' => 'required',
            'C_VISIT' => 'required',
            'ACCION' => 'required',
            'C_OBSE1' => 'required|min:3|max:250'
        ]
    );

    public function __construct()
    {
        $this->rc = new ResumenClass();
        $this->gc = new GestionClass();
        $this->rqc = new ResumenQueuesClass();
        $this->nc = new NotaClass();
        $this->fc = new ReferenciaClass();
    }

    /*
    private function getFields(Request $r)
    {
        $tl = date('r');
        $find0 = $r->find;
        $field = $r->field;
        $find = $this->rc->cleanFind($find0);
        $notas = $this->rc->notAlert($capt);
    }
    */

    /**
     *
     * @return View
     * @throws \Exception
     */
    public function ultima()
    {
        $capt = auth()->user()->iniciales;
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
     * @throws \Exception
     */
    public function find($id_cuenta)
    {
        $capt = auth()->user()->iniciales;
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
     * @param Request $r
     * @return View
     * @throws \Exception
     */
    public function capture(Request $r)
    {
        $validator = new Validator();
        $validator->make($r->all(), $this->visitValidator);
        $vc = new ValidationClass();
        $valid = $vc->countVisitErrors($r->all());
        if ($valid->flag) {
            return $this->ultima()->with($valid);
        }
        $this->gc->doVisit($r->all());
        $view = $this->index();
        return $view;
    }

    /**
     * @param Request $r
     * @return View
     * @throws \Exception
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
     * @param Request $r
     * @return View
     * @throws \Exception
     */
    public function gestion(Request $r)
    {
        $validator = new Validator();
        $validator->make($r->all(), $this->gestionValidator);
        $vc = new ValidationClass();
        $valid = $vc->countGestionErrors($r->all());
        if ($valid->flag) {
            return $this->ultima()->with($valid);
        }
        $this->gc->doGestion($r->all());
        $view = $this->index();
        return $view;
    }

    /**
     *
     * @return View
     * @throws \Exception
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        $capt = $user->iniciales;
        $camp = $user->camp;
        $result = $this->rqc->getResumen($capt, $camp);
        $id_cuenta = $result['id_cuenta'];
        $history = $this->rc->getHistory($id_cuenta);
        $from = '';
        $view = $this->buildView($result, $history, $from, $capt);
        return $view;
    }

    /**
     * @param array $result
     * @param array $history
     * @param string $from
     * @param string $capt
     * @return mixed
     * @throws \Exception
     */
    private function buildView(array $result, array $history, $from, $capt) {
        $id_cuenta = $result['id_cuenta'];
        $tipo = auth()->user()->tipo;
        $camp = auth()->user()->camp;
        $queue = $this->rqc->getMyQueue($capt, $camp);
        $sdc = $queue['sdc'];
        $cr = $queue['cr'];
        $numgest = $this->rc->getNumGests($capt);
        $tl = $this->rc->getTimeLock($id_cuenta);
        $notas = $this->nc->notAlert($capt);
        $acciones = $this->rc->getAccion();
        $accionesV = $this->rc->getAccionV();
        $dictamenes = $this->rc->getDict($tipo);
        $dictamenesV = $this->rc->getDictV();
        $motiv = $this->rc->getMotiv();
        $motivV = $this->rc->getMotivV();
        $visitadores = $this->rc->getVisitadorList();
        $gestores = $this->rc->getGestorList();
        $cnp = $this->rc->getCnp();
        $referencias = $this->fc->index($id_cuenta);
        /**
         * @var View
         */
        $baseView = view('resumen');
        /** @noinspection PhpUndefinedMethodInspection */
        $view = $baseView
        ->with('r', $result)
        ->with('history', $history)
        ->with('notas', $notas)
        ->with('acciones', $acciones)
        ->with('accionesV', $accionesV)
        ->with('dictamenes', $dictamenes)
        ->with('dictamenesV', $dictamenesV)
        ->with('motiv', $motiv)
        ->with('motivV', $motivV)
        ->with('cnp', $cnp)
        ->with('referencias', $referencias)
        ->with('gestores', $gestores)
        ->with('visitadores', $visitadores)
        ->with('capt', $capt)
        ->with('tipo', $tipo)
        ->with('tl', $tl)
        ->with('sdc', $sdc)
        ->with('cr', $cr)
        ->with('numgest', $numgest)
        ->with('from', $from);
        return $view;
    }
}