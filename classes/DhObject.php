<?php


namespace cobra_salsa;

require_once __DIR__ . '/ResumenObject.php';

class DhObject extends ResumenObject
{
    /**
     * @var int
     */
    public $n_prom = 0;

    /**
     * @var string
     */
    public $d_prom = '';

    /**
     * @var string
     */
    public $c_hrin = '';

    /**
     * @var int
     */
    public $v_cc = 99;
}