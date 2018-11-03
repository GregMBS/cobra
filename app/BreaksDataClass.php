<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 9/12/18
 * Time: 11:01 AM
 */

namespace App;


class BreaksDataClass
{
    /**
     * @var int
     */
    private $auto;

    /**
     * @var string
     */
    private $agent;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $finish;

    /**
     * @param int $auto
     */
    public function setAuto($auto)
    {
        $this->auto = $auto;
    }

    /**
     * @param string $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @param string $agent
     */
    public function setAgent($agent)
    {
        $this->agent = $agent;
    }

    /**
     * @param string $finish
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return \stdClass
     */
    public function getBreak()
    {
        $object = new \stdClass();
        $object->auto = $this->auto;
        $object->start = $this->start;
        $object->gestor = $this->agent;
        $object->finish = $this->finish;
        $object->tipo = $this->tipo;
        return $object;
    }
}