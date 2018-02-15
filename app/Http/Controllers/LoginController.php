<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use app\LoginClass;
use app\PdoClass;

class LoginController extends Controller
{
    /**
     *
     * @var LoginClass
     */
    private $lc;
    
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
    
    public function __construct() {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectNobody();
        $this->lc = new LoginClass($this->pdo);
    }
    
    /**
     * 
     * @param Request $r
     * @return RedirectResponse
     */
    public function login(Request $r) {
        $capt = $r->capt;
        $pwd = $r->pwd;
        $local = $r->ip();
        $userData = $this->lc->getUserData($capt, $pwd);
        if ($userData) {
            $tipo = $userData['tipo'];
            $enlace = $userData['enlace'];
            $this->lc->processLogin($capt, $pwd, $tipo, $local);
            $redirect = redirect()->route($enlace,['capt'=>$capt]);
            return $redirect;
        }
        return redirect('/');
    }
}
