<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;
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
     * @param Request $r
     * @return RedirectResponse
     */
    public function login(Request $r)
    {
        $capt = $r->capt;
        $pwd = $r->pwd;
        $local = $r->ip();
        $userData = $this->lc->getUserData($capt, $pwd);
        if ($userData) {
            $tipo = $userData['tipo'];
            $enlaceString = $userData['enlace'];
            $enlaceArray = explode('.', $enlaceString, 2);
            $enlace = $enlaceArray[0];
            $cookie = $this->lc->processLogin($capt, $pwd, $tipo, $local);
            $r->session()->put('auth', $cookie);
            $redirect = redirect()->to($enlace, 302);
            return $redirect;
        }
        return redirect('/');
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
     * @return RedirectResponse
     */
    public function logout($why)
    {
        $terminal = arraY(
            'salir',
            'error'
        );
        $cookie = session('auth', '');
        $capt = $this->lc->getCapt($cookie);
        $redirect = redirect('/');
        if ($capt) {
            $this->loc->processLogout($capt, $why);
            if (! in_array($why, $terminal)) {
                $redirect = redirect('/breaks/' . $capt);
            }
        }
        return $redirect;
    }

}
