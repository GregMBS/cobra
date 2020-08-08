<?php

namespace cobra_salsa;

require_once __DIR__ . '/DateClass.php';

/**
 * Description of BigInputObject
 *
 * @author gmbs
 */
class BigInputObject extends DateClass {

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
     * @var string
     */
    public $minDate = '2007-10-17';

    /**
     *
     * @var string
     */
    public $maxDateGestion = '2030-12-31';

    /**
     *
     * @var string
     */
    public $maxDateProm = '2030-12-31';

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
    $fecha1, $fecha2, $gestor, $cliente, $fecha3 = '2007-10-17', $fecha4 = '2030-12-31', $tipo = ""
    ) {
        $this->maxDateGestion = date("Y-m-d");
        $this->fecha1 = $this->fixDate($fecha1, $this->minDate);
        $this->fecha2 = $this->fixDate($fecha2, $this->maxDateGestion);
        $this->fecha3 = $this->fixDate($fecha3, $this->minDate);
        $this->fecha4 = $this->fixDate($fecha4, $this->maxDateProm);
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
     * @return boolean
     */
    public function hasGestor() {
        return ($this->gestor != 'todos');
    }

    /**
     * 
     * @return boolean
     */
    public function hasCliente() {
        return ($this->cliente != 'todos');
    }

    /**
     * 
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
        $str = "";
        if ($this->hasGestor()) {
            $str = " and c_cvge=:gestor ";
        }
        $tipoStr = $this->getTipoStr();
        return $str . $tipoStr;
    }

    /**
     * 
     * @return string
     */
    public function getClienteStr() {
        $str = "";
        if ($this->hasCliente()) {
            $str = " and c_cvba=:cliente ";
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
                return " and c_visit <> '' and c_msge is null ";
            case 'telefono':
                return " and c_visit IS NULL and c_msge is null ";
            case 'admin':
                return " and c_msge <> '' ";
            case 'noAdmin':
                return " and c_msge IS NULL ";
            default :
                return " ";
        }
    }

}
