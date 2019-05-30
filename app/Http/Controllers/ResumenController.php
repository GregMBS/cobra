<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGestion;
use App\Http\Requests\StoreVisit;
use App\ResumenClass;
use App\ResumenQueuesClass;
use App\User;
use App\ValidationClass;
use App\ValidationErrorClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\CallClass;
use View;
use App\NoteClass;
use App\ReferenciaClass;

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
     * @var CallClass
     */
    private $gc;

    /**
     *
     * @var NoteClass
     */
    private $nc;

    /**
     *
     * @var ReferenciaClass
     */
    private $fc;

    protected $redirect;

    public function __construct()
    {
        $this->rc = new ResumenClass();
        $this->gc = new CallClass();
        $this->rqc = new ResumenQueuesClass();
        $this->nc = new NoteClass();
        $this->fc = new ReferenciaClass();
    }
    /**
     * @param ValidationErrorClass $valid
     * @return View
     * @throws \Exception
     */
    public function latest(ValidationErrorClass $valid)
    {
        $capt = auth()->user()->iniciales;
        $id_cuenta = $this->rc->lastGestion($capt);
        return redirect('/resumen/' . $id_cuenta)->with('valid', $valid);
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
     * @param StoreVisit $r
     * @return View
     * @throws \Exception
     */
    public function capture(StoreVisit $r)
    {
        $vc = new ValidationClass();
        $valid = $vc->countVisitErrors($r->all());
        if ($valid->flag) {
            return $this->latest($valid);
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
        $valid = new ValidationErrorClass();
        $view = $this->latest($valid);
        return $view;
    }

    /**
     * @param StoreGestion $r
     * @return RedirectResponse|\Illuminate\Routing\Redirector|View
     * @throws \Exception
     */
    public function gestion(StoreGestion $r)
    {
        $vc = new ValidationClass();
        $valid = $vc->countGestionErrors($r->all());
        if ($valid->flag) {
            dd('invalid');
        }
        $this->gc->doCall($r->all());
        return redirect('/resumen');
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
        if ($result) {
            $id_cuenta = $result['id_cuenta'];
            $history = $this->rc->getHistory($id_cuenta);
            $from = '';
            $view = $this->buildView($result, $history, $from, $capt);
        } else {
            $view = view('resumen');
        }
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
    private function buildView(array $result, array $history, $from, $capt)
    {
        $id_cuenta = $result['id_cuenta'];
        $tipo = auth()->user()->tipo;
        $camp = auth()->user()->camp;
        $queue = $this->rqc->getMyQueue($capt, $camp);
        $sdc = $queue['sdc'];
        $cr = $queue['cr'];
        $numgest = $this->rc->getNumGests($capt);
        $tl = $this->rc->getTimeLock($id_cuenta);
        $notas = $this->nc->noteAlert($capt);
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
        $imagePath = public_path('images/') . $id_cuenta . '.jpg';
        $photo_exists = file_exists($imagePath);
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
            ->with('from', $from)
            ->with('camp', $camp)
            ->with('photo_exists', $photo_exists);
        return $view;
    }
}