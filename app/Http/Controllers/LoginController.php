<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use App\LoginClass;
use App\LogoutClass;

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

    public function __construct()
    {
        $this->lc = new LoginClass();
        $this->loc = new LogoutClass();
    }

    /**
     *
     * @param string $capt
     * @param string $why
     * @return RedirectResponse
     * @throws Exception
     */
    public function adminLogout($capt, $why)
    {
        try {
            $this->loc->processLogout($capt, $why);
        } catch (Exception $e) {
            throw $e;
        }
        $redirect = redirect('/quick');
        return $redirect;
    }

    /**
     *
     * @param string $why
     * @return RedirectResponse
     * @throws Exception
     */
    public function logout($why)
    {
        $terminal = arraY(
            'salir',
            'error'
        );
        $capt = auth()->user()->iniciales;
        $redirect = redirect('/');
        if ($capt) {
            try {
                $this->loc->processLogout($capt, $why);
            } catch (Exception $e) {
                throw $e;
            }
            auth()->logout();
            if (!in_array($why, $terminal)) {
                $redirect = redirect('/breaks/' . $capt);
            }
        }
        return $redirect;
    }

}
