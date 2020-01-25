<?php

namespace App\Http\Controllers;

use App\BreaksDataClass;
use App\UserClass;
use Exception;
use Illuminate\Validation\ValidationException;
use View;
use App\BreaksClass;
use Illuminate\Http\Request;

class BreaksController extends Controller
{
    /**
     *
     * @var BreaksClass
     */
    private $bc;

    /**
     *
     * @var UserClass
     */
    private $uc;

    public function __construct() {
        $this->bc = new BreaksClass();
        $this->uc = new UserClass();
    }
    
    /**
     *
     * @param string $capt
     * @return View|\Illuminate\View\View
     */
    public function index($capt) {
        $result = $this->bc->breaksPageData($capt);
        $view = view('breaks')->with('result', $result);
        return $view;
    }
    
    /**
     *
     * @return View|\Illuminate\View\View
     */
    public function admIndex() {
        $breaks = $this->bc->listBreaks();
        $gestores = $this->uc->listUsers();
        $view = view('breakAdmin')
        ->with('breaks', $breaks)
        ->with('gestores', $gestores);
        return $view;
    }

    /**
     * @param int $auto
     * @return View
     * @throws Exception
     */
    public function erase($auto) {
        $this->bc->deleteBreak($auto);
        return $this->admIndex();
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws ValidationException
     */
    public function change(Request $r) {
        try {
            $this->validate($r, [
                'auto' => 'required|exists:breaks|integer',
                'tipo' => 'required',
                'start' => 'required',
                'finish' => 'required'
            ]);
        } catch (ValidationException $e) {
            throw $e;
        }
        $break = new BreaksDataClass();
        $break->setAuto($r->auto);
        $break->setTipo($r->tipo);
        $break->setStart($r->start);
        $break->setFinish($r->finish);
        $this->bc->updateBreak($break);
        return $this->admIndex();
    }

    /**
     *
     * @param Request $r
     * @return View
     * @throws ValidationException
     */
    public function add(Request $r) {
        try {
            $this->validate($r, [
                'gestor' => 'required',
                'tipo' => 'required',
                'start' => 'required',
                'finish' => 'required'
            ]);
        } catch (ValidationException $e) {
            throw $e;
        }
        $break = new BreaksDataClass();
        $break->setGestor($r->gestor);
        $break->setTipo($r->tipo);
        $break->setStart($r->start);
        $break->setFinish($r->finish);
        $this->bc->insertBreak($break);
        return $this->admIndex();
    }
}
