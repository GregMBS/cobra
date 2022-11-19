<?php


namespace cobra_salsa;


class TimesheetDayObject
{
    /**
     * @var string
     */
    public string $start = ' ';

    /**
     * @var string
     */
    public string $stop  = ' ';

    /**
     * @var int
     */
    public int $diff  = 0;

    /**
     * @var int
     */
    public int $break = 0;

    /**
     * @var int
     */
    public int $bano  = 0;

    /**
     * @var int
     */
    public int $lla   = 0;

    /**
     * @var int
     */
    public int $tlla  = 0;

    /**
     * @var int
     */
    public int $prom  = 0;

    /**
     * @var int
     */
    public int $pag   = 0;

    /**
     * @var int
     */
    public int $lph   = 0;

    /**
     * @var int
     */
    public int $ct    = 0;

    /**
     * @var int
     */
    public int $nct   = 0;
}