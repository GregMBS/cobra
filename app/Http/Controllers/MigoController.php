<?php

namespace App\Http\Controllers;

use App\MigoClass;
use App\PdoClass;
use Illuminate\Support\Facades\View;

class MigoController extends Controller
{
    /**
     *
     * @var MigoClass
     */
    private $mc;
    
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
    
    /**
     * @var string
     */
    private $capt;
    
    public function __construct() {
        $this->pdoc = new PdoClass();
        $this->pdo = $this->pdoc->dbConnectUser();
        $this->mc = new MigoClass($this->pdo);
        $this->capt = $this->pdoc->capt;
    }
    
    /**
     * 
     * @return View
     */
    public function adminList() {
        if ($this->pdoc->getUserType($this->capt) == 'admin') {
            $result = $this->mc->adminReport();
            $view = view('migo')->with('result', $result);
            return $view;
        }
        return $this->userList();
    }
    
    /**
     *
     * @return View
     */
    public function userList() {
        $result = $this->mc->userReport($this->capt);
        dd($this);
        $view = view('migo')->with('result', $result)->with('capt', $this->capt);
        return $view;
    }
}
