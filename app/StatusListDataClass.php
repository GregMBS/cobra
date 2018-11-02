<?php

namespace App;

/**
 * Class StatusListDataClass
 * @package App
 */
class StatusListDataClass
{
    /**
     * @var string
     */
    public $client = '';

    /**
     * @var string
     */
    public $queue = '';

    /**
     * @var string
     */
    public $sdc = '';

    /**
     * @var string
     */
    public $statusString = '';

    /**
     * @var string
     */
    public $rateString = '';

    public function __construct(array $array)
    {
        $this->client = $array['cliente'];
        $this->sdc = $array['sdc'];
        $this->queue = $array['queue'];
        $this->statusString = $this->getStatusString();
        $this->rateString = $this->getRateString($array['rato']);
    }

    /**
     *
     * @param string $rate
     * @return string
     */
    private function getRateString($rate) {
        switch ($rate) {
            case 'diario':
                // daily
                $rateString = " AND fecha_ultima_gestion>curdate() ";
                break;
            case 'semanal':
                // weekly
                $rateString = "AND week(fecha_ultima_gestion)=week(curdate()) AND year(fecha_ultima_gestion)=year(curdate()) ";
                break;
            case 'mensual':
                // monthly
                $rateString = "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";
                break;
            default:
                $rateString = "";
                break;
        }
        return $rateString;
    }

    /**
     * @return string
     */
    private function getStatusString()
    {
        $statusString = 'AND status_de_credito not regexp "-" ';
        if (!(empty($this->sdc))) {
            $statusString = "AND status_de_credito=:sdc ";
        }
        return $statusString;
    }
}