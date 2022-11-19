<?php


namespace cobra_salsa;


class PagosObject
{
    /**
     * @var int
     */
    public int $auto = 0;

    /**
     * @var string
     */
    public $cuenta = '';

    /**
     * @var string
     */
    public $fecha = '';

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
    public $gestor = '';

    /**
     * @var int
     */
    public int $confirmado = 0;

    /**
     * @var string
     */
    public $credito = '';

    /**
     * @var int
     */
    public int $id_cuenta = 0;

    /**
     * @var string
     */
    public $fechacapt = '';

    /**
     * @var string[]
     */
    private array $NoSi = [
        'NO',
        'S&Iacute;'
    ];

    /**
     * @return string
     */
    public function confString(): string
    {
        return $this->NoSi[$this->confirmado];
    }
}