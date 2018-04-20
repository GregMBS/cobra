<?php
namespace App;

/**
 *
 * @author gmbs
 *        
 */
class HorariosDataClass
{
    /**
     * 
     * @var int
     */
    private $index;
    
    /**
     *
     * @var string
     */
    public $start;
    
    /**
     * 
     * @var string
     */
    public $stop;

    /**
     *
     * @var string
     */
    public $diff;
    
    /**
     *
     * @var string
     */
    public $break;
    
    /**
     *
     * @var string
     */
    public $bano;
    
    /**
     *
     * @var int
     */
    public $gestiones;
    
    /**
     *
     * @var int
     */
    public $cuentas;
    
    /**
     *
     * @var int
     */
    public $contactos;
    
    /**
     *
     * @var int
     */
    public $nocontactos;
    
    /**
     *
     * @var int
     */
    public $promesas;
    
    /**
     *
     * @var int
     */
    public $pagos;
    
    public function __construct($index) {
        $this->index = $index;
    }
    
    /**
     * 
     * @return number
     */
    public function getIndex() {
        return $this->index;
    }
}

