<?php


namespace cobra_salsa;


class UserDataObject
{
    /**
     * @var string
     */
    public string $USUARIA = '';

    /**
     * @var string
     */
    public string $INICIALES = '';

    /**
     * @var string
     */
    public string $COMPLETO = '';

    /**
     * @var string
     */
    public string $TIPO = '';

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
    public string $passw = '';

    /**
     * @var bool|null
     */
    public ?bool $policy = true;

    /**
     * @var int
     */
    public int $id = 0;

}