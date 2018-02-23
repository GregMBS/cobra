<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Support\Facades\DB;

/**
 * Description of ActivarClass
 *
 * @author gmbs
 */
class BaseClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    /**
     * 
     * @param \PDO $pdo
     */
    public function __construct() {
        $this->pdo = DB::connection()->getPdo();
    }
}
