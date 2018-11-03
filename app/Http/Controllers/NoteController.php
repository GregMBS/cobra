<?php

namespace App\Http\Controllers;

use App\NoteClass;
use App\DebtorClass;
use App\UserClass;
use Illuminate\Http\Request;
use View;

class NoteController extends Controller
{
    /**
     *
     * @var NoteClass
     */
    private $nc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    /**
     *
     * @var DebtorClass
     */
    private $rc;

    public function __construct()
    {
        $this->nc = new NoteClass();
        $this->uc = new UserClass();
        $this->rc = new DebtorClass();
    }

    /**
     *
     * @param int $id
     * @return View
     */
    public function index($id = 0)
    {
        $account = $this->rc->getAccountNumberFromId($id);
        $capt = auth()->user()->iniciales;
        $notes = $this->nc->listMyNotes($capt);
        /** @var View $view */
        $view = view('notas');
        $view = $view->with('id_cuenta', $id)
            ->with('cuenta', $account)
            ->with('capt', $capt)
            ->with('notas', $notes);
        return $view;
    }

    /**
     *
     * @param int $id
     * @return View
     */
    public function indexAdmin($id = 0)
    {
        $account = $this->rc->getAccountNumberFromId($id);
        $notes = $this->nc->listAllNotes();
        $agents = $this->uc->listUsers();
        $view = view('notadmin')
            ->with('gestores', $agents)
            ->with('cuenta', $account)
            ->with('notas', $notes);
        return $view;
    }

    /**
     *
     * @param int $id
     * @return View
     */
    public function remove($id)
    {
        $capt = auth()->user()->iniciales;
        $this->nc->softDeleteOneNote($capt, $id);
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
        $today = date('Y-m-d');
        $now = date('H:i:s');
        $id = $r->C_CONT;
        $account = $this->rc->getAccountNumberFromId($id);
        $date = $r->fecha;
        $time = $r->hora . ':' . $r->min;
        $note = $r->nota;
        $id = $this->nc->insertNote($capt, $today, $now, $date, $time, $note, $account, $id);
        return $this->index($id);
    }

    /**
     *
     * @param Request $r
     * @return View
     */
    public function addAdmin(Request $r)
    {
        $capt = auth()->user()->iniciales;
        $id = $r->C_CONT;
        $date = $r->fecha;
        $time = $r->hora . ':' . $r->min;
        $note = $r->nota;
        $target = $r->target;
        $this->nc->insertNoteAdmin($target, $capt, $date, $time, $note);
        return $this->indexAdmin($id);
    }
}
