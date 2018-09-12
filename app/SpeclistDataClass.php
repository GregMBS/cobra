<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 9/11/18
 * Time: 5:28 PM
 */

namespace App;


class SpeclistDataClass
{
    /**
     * @var string
     */
    public $cliente = '';

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
    public $sdcString = '';

    /**
     * @var string
     */
    public $ratoString = '';

    public function __construct(array $array)
    {
        $this->cliente = $array['cliente'];
        $this->queue = $array['queue'];
        $this->sdc = $array['sdc'];
        $this->sdcString = $this->getSdcString();
        $this->ratoString = $this->getRatoString($array['rato']);
    }

    /**
     *
     * @param string $rato
     * @return string
     */
    private function getRatoString($rato) {
        switch ($rato) {
            case 'diario':
                $ratoString = " AND fecha_ultima_gestion>curdate() ";
                break;
            case 'semanal':
                $ratoString = "AND week(fecha_ultima_gestion)=week(curdate())
        AND year(fecha_ultima_gestion)=year(curdate()) ";
                break;
            case 'mensual':
                $ratoString = "AND fecha_ultima_gestion > last_day(curdate() - interval 1 month) + interval 1 day ";
                break;
            default:
                $ratoString = "";
                break;
        }
        return $ratoString;
    }

    /**
     * @param string $sdc
     * @return string
     */
    private function getSdcString()
    {
        $sdcString = 'AND status_de_credito not regexp "-" ';
        if (!(empty($this->sdc))) {
            $sdcString = "AND status_de_credito=:sdc ";
        }
        return $sdcString;
    }
}