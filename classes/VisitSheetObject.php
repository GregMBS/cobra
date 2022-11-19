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
    public string $numero_de_cuenta;

    /**
     * @var string
     */
    public string $nombre_deudor;

    /**
     * @var string
     */
    public string $cliente;

    /**
     * @var float
     */
    public float $saldo_total;

    /**
     * @var string
     */
    public string $queue;

    /**
     * @var string
     */
    public string $completo;

    /**
     * @var string
     */
    public string $fechaout;

    /**
     * @var string
     */
    public string $fechain;

    /**
     * @var string
     */
    public string $gestor;
}