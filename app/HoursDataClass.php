<?php
namespace App;

/**
 *
 * @author gmbs
 *        
 */
class HoursDataClass
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
    public $restroom;
    
    /**
     *
     * @var int
     */
    public $calls;
    
    /**
     *
     * @var int
     */
    public $accounts;
    
    /**
     *
     * @var int
     */
    public $contacts;
    
    /**
     *
     * @var int
     */
    public $noContacts;
    
    /**
     *
     * @var int
     */
    public $promises;
    
    /**
     *
     * @var int
     */
    public $payments;
    
    public function __construct($index) {
        $this->index = $index;
    }
}

