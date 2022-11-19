<?php


namespace cobra_salsa;


class PagosQueryObject
{
    /**
     * @var string
     */
    public $cuenta = '';

    /**
     * @var string
     */
    public $fecha = '';

    /**
     * @var string
     */
    public $fechacapt = '';

    /**
     * @var float|null
     */
    public ?float $monto = 0;

    /**
     * @var string
     */
    public $cliente = '';

    /**
     * @var string
     */
    public $sdc = '';

    /**
     * @var string
     */
    public $gestor = '';

    /**
     * @var int
     */
    public int $confirmado = 0;

    /**
     * @var int
     */
    public int $id_cuenta = 0;

    /**
     * @var string
     */
    public $credit = '';
}