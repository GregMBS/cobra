<?php


namespace cobra_salsa;


class PagosQueryObject
{
    /**
     * @var string
     */
    public string $cuenta = '';

    /**
     * @var string
     */
    public string $fecha = '';

    /**
     * @var string
     */
    public string $fechacapt = '';

    /**
     * @var float
     */
    public float $monto = 0;

    /**
     * @var string
     */
    public string $cliente = '';

    /**
     * @var string
     */
    public string $sdc = '';

    /**
     * @var string
     */
    public string $gestor = '';

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
    public string $credit = '';
}