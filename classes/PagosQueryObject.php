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
     * @var float
     */
    public $monto = 0;

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
    public $confirmado = 0;

    /**
     * @var int
     */
    public $id_cuenta = 0;

    /**
     * @var string
     */
    public $credit = '';
}