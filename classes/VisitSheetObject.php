<?php


namespace cobra_salsa;


class VisitSheetObject
{
    /**
     * @var int
     */
    public int $id_cuenta = 0;

    /**
     * @var string|null
     */
    public ?string $numero_de_cuenta;

    /**
     * @var string|null
     */
    public ?string $nombre_deudor;

    /**
     * @var string|null
     */
    public ?string $cliente;

    /**
     * @var float|null
     */
    public ?float $saldo_total = 0;

    /**
     * @var string|null
     */
    public ?string $queue;

    /**
     * @var string|null
     */
    public ?string $completo;

    /**
     * @var string|null
     */
    public ?string $fechaout;

    /**
     * @var string|null
     */
    public ?string $fechain;

    /**
     * @var string|null
     */
    public ?string $gestor;
}