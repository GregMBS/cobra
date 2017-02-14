<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cobra_salsa;

/**
 * Description of BigInputObject
 *
 * @author gmbs
 */
class BigInputObject {

    /**
     *
     * @var string
     */
    protected $fecha1;

    /**
     *
     * @var string
     */
    protected $fecha2;

    /**
     *
     * @var string
     */
    protected $fecha3;

    /**
     *
     * @var string
     */
    protected $fecha4;

    /**
     *
     * @var string
     */
    protected $tipo;

    /**
     *
     * @var string
     */
    protected $gestor;

    /**
     *
     * @var string
     */
    protected $cliente;

    /**
     * 
     * @param string $fecha1
     * @param string $fecha2
     * @param string $gestor
     * @param string $cliente
     * @param string $fecha3
     * @param string $fecha4
     * @param string $tipo
     */
    public function __construct(
    $fecha1, $fecha2, $gestor, $cliente, $fecha3 = "", $fecha4 = "", $tipo = ""
    ) {
        $this->fecha1 = $fecha1;
        $this->fecha2 = $fecha2;
        $this->fecha3 = $fecha3;
        $this->fecha4 = $fecha4;
        $this->gestor = $gestor;
        $this->cliente = $cliente;
        $this->tipo = $tipo;
        $this->alignDates();
    }

    /**
     * 
     * @return string
     */
    public function getFecha1() {
        return $this->fecha1;
    }


    /**
     * 
     * @return string
     */
    public function getFecha2() {
        return $this->fecha2;
    }


    /**
     * 
     * @return string
     */
    public function getFecha3() {
        return $this->fecha3;
    }


    /**
     * 
     * @return string
     */
    public function getFecha4() {
        return $this->fecha4;
    }


    /**
     * 
     * @return string
     */
    public function getGestor() {
        return $this->gestor;
    }


    /**
     * 
     * @return string
     */
    public function getCliente() {
        return $this->cliente;
    }


    /**
     * 
     * @return string
     */
    public function getTipo() {
        return $this->tipo;
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasGestor() {
        $test = ($this->gestor != 'todos');
        return $test;
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasCliente() {
        $test = ($this->cliente != 'todos');
        return $test;
    }
    
    /**
     * 
     * @return array
     */
    private function alignDates() {
        if ($this->fecha2 < $this->fecha1) {
            list($this->fecha1, $this->fecha2) = array($this->fecha2, $this->fecha1);
        }
        if ($this->fecha4 < $this->fecha3) {
            list($this->fecha3, $this->fecha4) = array($this->fecha4, $this->fecha3);
        }
    }
    
    /**
     * 
     * @return string
     */
    public function getGestorStr() {
        if ($this->hasGestor()) {
            $str = " and c_cvge=:gestor ";
        } else {
            $str = "";
        }
        $tipoStr = $this->getTipoStr();
        return $str.$tipoStr;
    }


    /**
     * 
     * @return string
     */
    public function getClienteStr() {
        if ($this->hasCliente()) {
            $str = " and c_cvba=:cliente ";
        } else {
            $str = "";
        }
        return $str;
    }

    /**
     * 
     * @return string
     */
    private function getTipoStr() {
        switch ($this->tipo) {
            case 'visits':
                $tipostr = " and c_visit <> '' and c_msge is null ";
                break;
            case 'telef':
                $tipostr = " and c_visit IS NULL and c_msge is null ";
                break;
            case 'admin':
                $tipostr = " and c_msge <> '' ";
                break;
            case 'noadmin':
                $tipostr = " and c_msge IS NULL ";
                break;
            default :
                $tipostr = " ";
                break;
        }
        return $tipostr;
    }

}
