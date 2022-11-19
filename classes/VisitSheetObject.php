<?php


namespace cobra_salsa;


class VisitSheetObject
{
    /**
     * @var int
     */
    public int $id_cuenta;

    /**
     * @var string
     */
    public $numero_de_cuenta;

    /**
     * @var string
     */
    public $nombre_deudor;

    /**
     * @var string
     */
    public $cliente;

    /**
     * @var float
     */
    public float $saldo_total;

    /**
     * @var string
     */
    public $queue;

    /**
     * @var string|null
     */
    public ?string $completo;

    /**
     * @var string
     */
    public $fechaout;

    /**
     * @var string
     */
    public $fechain;

    /**
     * @var string
     */
    public $gestor;
}