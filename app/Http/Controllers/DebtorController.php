<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCall;
use App\Http\Requests\StoreVisit;
use App\DebtorClass;
use App\DebtorQueuesClass;
use App\User;
use App\ValidationClass;
use App\ValidationErrorClass;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\CallClass;
use View;
use App\NoteClass;
use App\ReferenceClass;

class DebtorController extends Controller
{

    /**
     *
     * @var DebtorClass
     */
    private $rc;

    /**
     *
     * @var DebtorQueuesClass
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
     * @var ReferenceClass
     */
    private $fc;

    protected $redirect;

    public function __construct()
    {
        $this->rc = new DebtorClass();
        $this->gc = new CallClass();
        $this->rqc = new DebtorQueuesClass();
        $this->nc = new NoteClass();
        $this->fc = new ReferenceClass();
    }
    /**
     * @param ValidationErrorClass $valid
     * @return View
     * @throws \Exception
     */
    public function latest(ValidationErrorClass $valid)
    {
        $capt = auth()->user()->iniciales;
        $id = $this->rc->lastCall($capt);
        return redirect('/resumen/' . $id)->with('valid', $valid);
    }

    /**
     *
     * @param int $id
     * @return View
     * @throws \Exception
     */
    public function find($id)
    {
        $capt = auth()->user()->iniciales;
        $result = $this->rqc->getOne($id);
        $history = $this->rc->getHistory($id);
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
     * @param StoreCall $r
     * @return RedirectResponse|\Illuminate\Routing\Redirector|View
     * @throws \Exception
     */
    public function call(StoreCall $r)
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
        $result = $this->rqc->getDebtor($capt, $camp);
        if ($result) {
            $id = $result['id_cuenta'];
            $history = $this->rc->getHistory($id);
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
        $id = $result['id_cuenta'];
        $tipo = auth()->user()->tipo;
        $camp = auth()->user()->camp;
        $queue = $this->rqc->getMyQueue($capt, $camp);
        $sdc = $queue['sdc'];
        $cr = $queue['cr'];
        $countCalls = $this->rc->countCallsByAgent($capt);
        $tl = $this->rc->getTimeLock($id);
        $notes = $this->nc->noteAlert($capt);
        $actions = $this->rc->getAction();
        $actionsV = $this->rc->getActionVisit();
        $statuses = $this->rc->getStatus($tipo);
        $statusesV = $this->rc->getStatusVisit();
        $motives = $this->rc->getMotivation();
        $motivesV = $this->rc->getMotivationVisit();
        $visitors = $this->rc->getVisitorList();
        $agents = $this->rc->getAgentList();
        $cnp = $this->rc->getExcuse();
        $references = $this->fc->index($id);
        $imagePath = public_path('images/') . $id . '.jpg';
        $photo_exists = file_exists($imagePath);
        /**
         * @var View
         */
        $baseView = view('resumen');
        /** @noinspection PhpUndefinedMethodInspection */
        $view = $baseView
            ->with('r', $result)
            ->with('history', $history)
            ->with('notas', $notes)
            ->with('acciones', $actions)
            ->with('accionesV', $actionsV)
            ->with('dictamenes', $statuses)
            ->with('dictamenesV', $statusesV)
            ->with('motiv', $motives)
            ->with('motivV', $motivesV)
            ->with('cnp', $cnp)
            ->with('referencias', $references)
            ->with('gestores', $agents)
            ->with('visitadores', $visitors)
            ->with('capt', $capt)
            ->with('tipo', $tipo)
            ->with('tl', $tl)
            ->with('sdc', $sdc)
            ->with('cr', $cr)
            ->with('numgest', $countCalls)
            ->with('from', $from)
            ->with('camp', $camp)
            ->with('photo_exists', $photo_exists);
        return $view;
    }
}