<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use DateTime;

/**
 * Description of PagobulkRowClass
 *
 * @author gmbs
 */
class PagobulkRowClass {

    /**
     *
     * @var string
     */
    private $cuenta = '';

    /**
     *
     * @var string
     */
    private $fecha = '';

    /**
     *
     * @var float 
     */
    private $monto = 0;

    /**
     *
     * @var string
     */
    private $gestor = '';

    public function __construct($rowArray) {
        $this->setCuenta($rowArray[0]);
        $this->setFecha($rowArray[1]);
        $this->setMonto($rowArray[2]);
    }

    /**
     * 
     * @return string
     */
    public function getCuenta() {
        return $this->cuenta;
    }

    /**
     * 
     * @return string
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * 
     * @return float
     */
    public function getMonto() {
        return $this->monto;
    }

    /**
     * 
     * @return float
     */
    public function getGestor() {
        return $this->gestor;
    }

    /**
     * 
     * @param string $value
     */
    private function setCuenta($value) {
        $this->cuenta = $value;
    }

    /**
     * 
     * @param string $value
     */
    private function setFecha($value) {
        $time = strtotime($value);
        $date = date('Y-m-d');
        if ($time) {
            $date = date('Y-m-d', $time);
        }
        $this->fecha = $date;
    }

    /**
     * 
     * @param float $value
     * 
     */
    private function setMonto($value) {
        if (is_numeric($value)) {
            $this->monto = $value;
        }
    }

    /**
     * 
     * @param string $value
     */
    public function setGestor($value) {
        $this->gestor = $value;
    }

    /**
     * 
     * @return boolean
     */
    private function invalidCuenta() {
        return ($this->cuenta == '');
    }

    /**
     * 
     * @return boolean
     */
    private function validFecha() {
        $dt = new DateTime();
        $d = $dt->createFromFormat('Y-m-d', $this->fecha);
        return ($d && $d->format('Y-m-d') === $this->fecha);
    }

    /**
     * 
     * @return boolean
     */
    private function invalidMonto() {
        $isNum = is_numeric($this->monto);
        if ($isNum) {
            return ($this->monto == 0);
        }
        return false;
    }

    /**
     * 
     * @return boolean
     */
    public function valid() {
        $valid = TRUE;
        if ($this->invalidCuenta()) {
            $valid = FALSE;
        }
        if (!$this->validFecha()) {
            $valid = FALSE;
        }
        if ($this->invalidMonto()) {
            $valid = FALSE;
        }
        if (!is_numeric($this->monto)) {
            $valid = FALSE;
        }
        return $valid;
    }

}
