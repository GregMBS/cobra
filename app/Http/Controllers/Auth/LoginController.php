<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * 
     * @return string
     */
    public function username()
    {
        return 'iniciales';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
//            $this->fireLockoutEvent($request);
            abort(429);
//            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        if ($this->oldLogin($request)) {
            $password = $request->pwd;
            $id = $this->oldToNew($this->oldLogin($request), $password);
            // remove old in nombres
            auth()->loginUsingId($id);
            return $this->sendLoginResponse($request);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * 
     * @param Request $request
     * @return array
     */
    private function oldLogin(Request $request) {
        $pdo = DB::connection()->getPdo();
        $capt = $request->iniciales;
        $pw = $request->password;
        $query = "SELECT * FROM nombres 
            WHERE passw = sha(:pw) 
            AND LOWER(iniciales) = LOWER(:capt) 
            LIMIT 1";
        $std = $pdo->prepare($query);
        $std->bindValue(':pw', $pw);
        $std->bindValue(':capt', $capt);
        $std->execute();
        $result = $std->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     * 
     * @param array $oldData
     * @param string $password
     * @return int
     */
    private function oldToNew(array $oldData, $password) {
        /**
         * 
         * @var \PDO $pdo
         */
        $pdo = DB::connection()->getPdo();
        $pwd = bcrypt($password);
        $query = "INSERT IGNORE INTO users 
            (completo,iniciales,tipo,camp,password,created_at,updated_at) 
            VALUES (:completo,:iniciales,:tipo,:camp,:pwd,NOW(),NOW())";
        $sto = $pdo->prepare($query);
        $sto->bindValue(':completo', $oldData['completo']);
        $sto->bindValue(':iniciales', $oldData['iniciales']);
        $sto->bindValue(':tipo', $oldData['tipo']);
        $sto->bindValue(':camp', $oldData['camp']);
        $sto->bindValue(':pwd', $pwd);
        $sto->execute();
        $id = $pdo->lastInsertId();
        return $id;
    }
}
