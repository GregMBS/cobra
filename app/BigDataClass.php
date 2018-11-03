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
    public $agent = 'todos';
    
    /**
     *
     * @var string
     */
    public $client = 'todos';
    
        /**
     * 
     * @var string
     */
    public $tipo = '';

/**
     * 
     * @var Carbon
     */
    public $date1;

    /**
     * 
     * @var Carbon
     */
    public $date2;

    /**
     * 
     * @var Carbon
     */
    public $date3;

    /**
     * 
     * @var Carbon
     */
    public $date4;

    /**
     * 
     * @param Request $a
     * @return BigDataClass
     */
    public function __construct(Request $a)
    {
        $this->date1 = new Carbon('2007-10-19');
        $this->date2 = new Carbon('now');
        $this->date3 = new Carbon('2007-10-19');
        $this->date4 = new Carbon('now');
        if (env('APP_ENV') === 'testing') {
            $this->date1 = new Carbon('6 months ago');
            $this->date2 = new Carbon('now');
            $this->date3 = new Carbon('6 months ago');
            $this->date4 = new Carbon('now');
        }
        if ($a->has('gestor')) {
            $this->agent = $a->gestor;
        }
        if ($a->has('cliente')) {
            $this->client = $a->cliente;
        }
        if ($a->has('tipo')) {
            $this->tipo = $a->tipo;
        }
        if (strtotime($a->fecha1)) {
            $this->date1 = new Carbon($a->fecha1);
        }
        if (strtotime($a->fecha2)) {
            $this->date2 = new Carbon($a->fecha2);
        }
        if (strtotime($a->fecha3)) {
            $this->date3 = new Carbon($a->fecha3);
        }
        if (strtotime($a->fecha4)) {
            $this->date4 = new Carbon($a->fecha4);
        }
        $this->alignDates();
        return $this;
    }
    
    private function alignDates() {
        $array = [$this->date1, $this->date2];
        sort($array);
        $this->date1 = $array[0];
        $this->date2 = $array[1];
        $array = [$this->date3, $this->date4];
        sort($array);
        $this->date3 = $array[0];
        $this->date4 = $array[1];
    }
    
    /**
     *
     * @return boolean
     */
    public function hasAgent() {
        $has = ($this->agent != 'todos');
        return $has;
    }

    /**
     *
     * @return boolean
     */
    public function hasClient() {
        $has = ($this->client != 'todos');
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
    public function getAgentString() {
        $agentString = '';
        if ($this->agent != 'todos') {
            $agentString = " and c_cvge=:gestor ";
        }
        return $agentString;
    }
    
        /**
     * 
     * @return string
     */
    public function getClientString() {
        $clientString = '';
        if ($this->client != 'todos') {
            $clientString = " and c_cvba=:cliente ";
        }
        return $clientString;
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
            case 'tele':
                $tipoString = " and c_visit IS NULL and c_msge is null ";
                break;
           default :
               $tipoString = " ";
                break;
        }
        return $tipoString;
    }
    
    
}

