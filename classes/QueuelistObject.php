<?php


namespace cobra_salsa;


class QueuelistObject
{
    /**
     * @var int|null
     */
    public ?int $auto;

    /**
     * @var string|null
     */
    public ?string $gestor = '';

    /**
     * @var string|null
     */
    public ?string $cliente = '';

    /**
     * @var string|null
     */
    public ?string $status_aarsa = '';

    /**
     * @var int|null
     */
    public ?int $camp;

    /**
     * @var string|null
     */
    public ?string $orden1;

    /**
     * @var string|null
     */
    public ?string $updown1;

    /**
     * @var string|null
     */
    public ?string $orden2;

    /**
     * @var string|null
     */
    public ?string $updown2;

    /**
     * @var string|null
     */
    public ?string $orden3;

    /**
     * @var string|null
     */
    public ?string $updown3;

    /**
     * @var string|null
     */
    public ?string $sdc = '';

    /**
     * @var int|null
     */
    public ?int $bloqueado;

    /**
     * @return string
     */
    public function getClientString(): string
    {
        if (empty($this->cliente)) {
            return '';
        }
        return " AND cliente = '$this->cliente' ";
    }

    /**
     * @return string
     */
    public function getSDCString(): string
    {
        if (empty($this->sdc)) {
            return " AND status_de_credito not regexp '-' ";
        }
        return " AND status_de_credito = '$this->sdc' ";
    }

    /**
     * @return string
     */
    public function getCrString(): string
    {
        if (empty($this->status_aarsa)) {
            return " AND status_aarsa not in ('PAGO TOTAL','PAGO RECURRENTE','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION', 'QUEJA CONDUSEF') ";
        }
        return " AND queue = '$this->status_aarsa' ";
    }
}