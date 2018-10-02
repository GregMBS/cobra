<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 *
 * @author gmbs
 *        
 */
class BigDataClass
{
    /**
     *
     * @var string
     */
    public $gestor = 'todos';
    
    /**
     *
     * @var string
     */
    public $cliente = 'todos';
    
        /**
     * 
     * @var string
     */
    public $tipo = '';

/**
     * 
     * @var Carbon
     */
    public $fecha1;

    /**
     * 
     * @var Carbon
     */
    public $fecha2;

    /**
     * 
     * @var Carbon
     */
    public $fecha3;

    /**
     * 
     * @var Carbon
     */
    public $fecha4;

    /**
     * 
     * @param Request $a
     * @return BigDataClass
     */
    public function __construct(Request $a)
    {
        $this->fecha1 = new Carbon('2007-10-19');
        $this->fecha2 = new Carbon('now');
        $this->fecha3 = new Carbon('2007-10-19');
        $this->fecha4 = new Carbon('now');
        if ($a->has('gestor')) {
            $this->gestor = $a->gestor;
        }
        if ($a->has('cliente')) {
            $this->cliente = $a->cliente;
        }
        if ($a->has('tipo')) {
            $this->tipo = $a->tipo;
        }
        if (strtotime($a->fecha1)) {
            $this->fecha1 = new Carbon($a->fecha1);
        }
        if (strtotime($a->fecha2)) {
            $this->fecha2 = new Carbon($a->fecha2);
        }
        if (strtotime($a->fecha3)) {
            $this->fecha3 = new Carbon($a->fecha3);
        }
        if (strtotime($a->fecha4)) {
            $this->fecha4 = new Carbon($a->fecha4);
        }
        $this->alignDates();
        return $this;
    }
    
    private function alignDates() {
        $array = [$this->fecha1, $this->fecha2];
        sort($array);
        $this->fecha1 = $array[0];
        $this->fecha2 = $array[1];
        $array = [$this->fecha3, $this->fecha4];
        sort($array);
        $this->fecha3 = $array[0];
        $this->fecha4 = $array[1];
    }
    
    /**
     *
     * @return boolean
     */
    public function hasGestor() {
        $has = ($this->gestor != 'todos');
        return $has;
    }

    /**
     *
     * @return boolean
     */
    public function hasCliente() {
        $has = ($this->cliente != 'todos');
        return $has;
    }

    /**
     *
     * @return boolean
     */
    public function hasTipo() {
        /** @var boolean $has */
        $has = ($this->tipo !== '');
        return $has;
    }

    /**
     *
     * @return string
     */
    public function getGestorString() {
        $gestorstr = '';
        if ($this->gestor != 'todos') {
            $gestorstr = " and c_cvge=:gestor ";
        }
        return $gestorstr;
    }
    
        /**
     * 
     * @return string
     */
    public function getClienteString() {
        $clientestr = '';
        if ($this->cliente != 'todos') {
            $clientestr = " and c_cvba=:cliente ";
        }
        return $clientestr;
    }
    
/**
     *
     * @return string
     */
    public function getTipoString() {
        switch ($this->tipo) {
            case 'visits':
                $tipoString = " and c_visit <> '' and c_msge is null ";
                break;
            case 'telef':
                $tipoString = " and c_visit IS NULL and c_msge is null ";
                break;
           default :
               $tipoString = " ";
                break;
        }
        return $tipoString;
    }
    
    
}

