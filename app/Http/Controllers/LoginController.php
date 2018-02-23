<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\LoginClass;
use App\LogoutClass;
use App\PdoClass;

class LoginController extends Controller
{

    /**
     *
     * @var LoginClass
     */
    private $lc;

    /**
     *
     * @var LogoutClass
     */
    private $loc;

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

    public function __construct()
    {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectNobody();
        $this->lc = new LoginClass($this->pdo);
    }

    /**
     *
     * @param string $capt
     * @param string $why
     * @return RedirectResponse
     */
    public function adminLogout($capt, $why)
    {
        $this->loc->processLogout($capt, $why);
        $redirect = redirect('/quick');
        return $redirect;
    }

    /**
     * 
     * @param string $why
     * @param Request $r
     * @return RedirectResponse
     */
    public function logout($why, Request $r)
    {
        $terminal = arraY(
            'salir',
            'error'
        );
        $cookie = session('auth', '');
        $capt = $this->pdoc->getCapt($cookie);
        $redirect = redirect('/');
        if ($capt) {
            $this->loc->processLogout($capt, $why);
            $r->session()->flush();
            if (! in_array($why, $terminal)) {
                $redirect = redirect('/breaks/' . $capt);
            }
        }
        return $redirect;
    }

}
