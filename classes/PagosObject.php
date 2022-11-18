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
    public string $cuenta = '';

    /**
     * @var string
     */
    public string $fecha = '';

    /**
     * @var float
     */
    public $monto = 0;

    /**
     * @var string
     */
    public string $cliente = '';

    /**
     * @var string
     */
    public string $gestor = '';

    /**
     * @var int
     */
    public int $confirmado = 0;

    /**
     * @var string
     */
    public string $credito = '';

    /**
     * @var int
     */
    public int $id_cuenta = 0;

    /**
     * @var string
     */
    public string $fechacapt = '';

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