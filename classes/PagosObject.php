<?php


namespace cobra_salsa;


class PagosObject
{
    /**
     * @var int
     */
    public $auto = 0;

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
    public $confirmado = 0;

    /**
     * @var string
     */
    public $credito = '';

    /**
     * @var int
     */
    public $id_cuenta = 0;

    /**
     * @var string
     */
    public $fechacapt = '';

    private $NoSi = [
        'NO',
        'S&Iacute;'
    ];

    /**
     * @return string
     */
    public function confString()
    {
        return $this->NoSi[$this->confirmado];
    }
}