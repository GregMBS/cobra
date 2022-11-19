<?php


namespace cobra_salsa;


class QueuelistObject
{
    /**
     * @var int|null
     */
    var ?int $auto;

    /**
     * @var string|null
     */
    var ?string $gestor = '';

    /**
     * @var string|null
     */
    var ?string $cliente = '';

    /**
     * @var string|null
     */
    var ?string $status_aarsa = '';

    /**
     * @var int|null
     */
    var ?int $camp;

    /**
     * @var string|null
     */
    var ?string $orden1;

    /**
     * @var string|null
     */
    var ?string $updown1;

    /**
     * @var string|null
     */
    var ?string $orden2;

    /**
     * @var string|null
     */
    var ?string $updown2;

    /**
     * @var string|null
     */
    var ?string $orden3;

    /**
     * @var string|null
     */
    var ?string $updown3;

    /**
     * @var string|null
     */
    var ?string $sdc = '';

    /**
     * @var int|null
     */
    var ?int $bloqueado;

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