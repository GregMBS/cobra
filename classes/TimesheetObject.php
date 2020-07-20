<?php


namespace cobra_salsa;


class TimesheetObject
{
    /**
     * @var array
     */
    public $tsumt = [];

    /**
     * @var array
     */
    public $tsumb = [];

    /**
     * @var array
     */
    public $tsumg = [];

    /**
     * @var array
     */
    public $tsumgt = [];

    /**
     * @var array
     */
    public $tsumgt1 = [];

    /**
     * @var array
     */
    public $tsumgt2 = [];

    /**
     * @var array
     */
    public $tsumpp = [];

    /**
     * @var array
     */
    public $tsump = [];

    /**
     * @var array
     */
    public $tsumw = [];

    /**
     * @var array
     */
    public $tsumci = [];

    /**
     * @var array
     */
    public $tsumco = [];

    /**
     * @var array
     */
    public $tsumnct = [];

    /**
     * @var array
     */
    public $tsumct = [];

    /**
     * @var array
     */
    public $tsumbn = [];

    /**
     * TimesheetObject constructor.
     * @param int $dhoy
     */
    public function __construct(int $dhoy)
    {
        $zeros = array_fill(1, $dhoy, 0);
        $this->tsumt = $zeros;
        $this->tsumb = $zeros;
        $this->tsumg = $zeros;
        $this->tsumgt = $zeros;
        $this->tsumgt1 = $zeros;
        $this->tsumgt2 = $zeros;
        $this->tsumpp = $zeros;
        $this->tsump = $zeros;
        $this->tsumw = $zeros;
        $this->tsumci = $zeros;
        $this->tsumco = $zeros;
        $this->tsumnct = $zeros;
        $this->tsumct = $zeros;
        $this->tsumbn = $zeros;
    }
}