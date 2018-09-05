<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Support\Facades\DB;

/**
 * Base Class
 *
 * @author gmbs
 */
abstract class BaseClass {

    /**
     * @var \PDO $pdo
     */
    protected $pdo;

    public function __construct() {
        $this->pdo = DB::connection()->getPdo();
    }

    public function getReport()
    {
        return [];
    }
}
