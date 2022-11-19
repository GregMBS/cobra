<?php


namespace cobra_salsa;


class QueuesReportObject
{
    /**
     * @var int
     */
    public int $ctt = 0;

    /**
     * @var int
     */
    public int $ctd = 0;

    /**
     * @var int
     */
    public int $ctw = 0;

    /**
     * @var int
     */
    public int $ctm = 0;

    /**
     * @var float|null
     */
    public ?float $mtt = 0;

    /**
     * @var float|null
     */
    public ?float $mtd = 0;

    /**
     * @var float|null
     */
    public ?float $mtw = 0;

    /**
     * @var float|null
     */
    public ?float $mtm = 0;
}