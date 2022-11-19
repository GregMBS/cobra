<?php


namespace cobra_salsa;


class UserDataObject
{
    /**
     * @var string
     */
    public $USUARIA = '';

    /**
     * @var string
     */
    public $INICIALES = '';

    /**
     * @var string
     */
    public $COMPLETO = '';

    /**
     * @var string
     */
    public $TIPO = '';

    /**
     * @var string | null
     */
    public ?string $TICKET = '';

    /**
     * @var int
     */
    public int $camp = 0;

    /**
     * @var string|null
     */
    public ?string $turno = '';

    /**
     * @var string|null
     */
    public ?string $authcode = '';

    /**
     * @var string
     */
    public $passw = '';

    /**
     * @var bool|null
     */
    public ?bool $policy = true;

    /**
     * @var int
     */
    public int $id = 0;

}