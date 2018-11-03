<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use DateTime;

/**
 * Description of BulkPaymentsRowClass
 *
 * @author gmbs
 */
class BulkPaymentsRowClass {

    /**
     *
     * @var string
     */
    private $account = '';

    /**
     *
     * @var string
     */
    private $date = '';

    /**
     *
     * @var float 
     */
    private $amount = 0;

    /**
     *
     * @var string
     */
    private $agent = '';

    public function __construct($rowArray) {
        $this->setAccount($rowArray[0]);
        $this->setDate($rowArray[1]);
        $this->setAmount($rowArray[2]);
    }

    /**
     * 
     * @return string
     */
    public function getAccount() {
        return $this->account;
    }

    /**
     * 
     * @return string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * 
     * @return float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * 
     * @return float
     */
    public function getAgent() {
        return $this->agent;
    }

    /**
     * 
     * @param string $value
     */
    private function setAccount($value) {
        $this->account = $value;
    }

    /**
     * 
     * @param string $value
     */
    private function setDate($value) {
        $time = strtotime($value);
        $date = date('Y-m-d');
        if ($time) {
            $date = date('Y-m-d', $time);
        }
        $this->date = $date;
    }

    /**
     * 
     * @param float $value
     * 
     */
    private function setAmount($value) {
        if (is_numeric($value)) {
            $this->amount = $value;
        }
    }

    /**
     * 
     * @param string $value
     */
    public function setAgent($value) {
        $this->agent = $value;
    }

    /**
     * 
     * @return boolean
     */
    private function invalidAccount() {
        return ($this->account == '');
    }

    /**
     * 
     * @return boolean
     */
    private function validDate() {
        $dt = new DateTime();
        $d = $dt->createFromFormat('Y-m-d', $this->date);
        return ($d && $d->format('Y-m-d') === $this->date);
    }

    /**
     * 
     * @return boolean
     */
    private function invalidAmount() {
        $isNum = is_numeric($this->amount);
        if ($isNum) {
            return ($this->amount == 0);
        }
        return false;
    }

    /**
     * 
     * @return boolean
     */
    public function valid() {
        $valid = TRUE;
        if ($this->invalidAccount()) {
            $valid = FALSE;
        }
        if (!$this->validDate()) {
            $valid = FALSE;
        }
        if ($this->invalidAmount()) {
            $valid = FALSE;
        }
        if (!is_numeric($this->amount)) {
            $valid = FALSE;
        }
        return $valid;
    }

}
