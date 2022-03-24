<?php


namespace cobra_salsa;


class QueuelistObject
{
    /**
     * @var int
     */
    var $auto;

    /**
     * @var string
     */
    var $gestor = '';

    /**
     * @var string
     */
    var $cliente = '';

    /**
     * @var string
     */
    var $status_aarsa = '';

    /**
     * @var int
     */
    var $camp;

    /**
     * @var string
     */
    var $orden1;

    /**
     * @var string
     */
    var $updown1;

    /**
     * @var string
     */
    var $orden2;

    /**
     * @var string
     */
    var $updown2;

    /**
     * @var string
     */
    var $orden3;

    /**
     * @var string
     */
    var $updown3;

    /**
     * @var string
     */
    var $sdc = '';

    /**
     * @var int
     */
    var $bloqueado;

    /**
     * @return string
     */
    public function getClientString()
    {
        if (empty($this->cliente)) {
            return '';
        }
        return " AND cliente = '$this->cliente' ";
    }

    /**
     * @return string
     */
    public function getSDCString()
    {
        if (empty($this->sdc)) {
            return " AND status_de_credito not regexp '-' ";
        }
        return " AND status_de_credito = '$this->sdc' ";
    }

    /**
     * @return string
     */
    public function getCrString()
    {
        if (empty($this->status_aarsa)) {
            return " AND status_aarsa not in ('PAGO TOTAL','PAGO RECURRENTE','PAGO PARCIAL','PAGANDO CONVENIO', 'ACLARACION', 'QUEJA CONDUSEF') ";
        }
        return " AND queue = '$this->status_aarsa' ";
    }
}