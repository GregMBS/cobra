<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 9/12/18
 * Time: 11:01 AM
 */

namespace App;

use \stdClass;

class BreaksDataClass
{
    /**
     * @var int
     */
    private $auto;

    /**
     * @var string
     */
    private $gestor;

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
     * @param string $gestor
     */
    public function setGestor($gestor)
    {
        $this->gestor = $gestor;
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
     * @return stdClass
     */
    public function getBreak()
    {
        $object = new stdClass();
        $object->auto = $this->auto;
        $object->start = $this->start;
        $object->gestor = $this->gestor;
        $object->finish = $this->finish;
        $object->tipo = $this->tipo;
        return $object;
    }
}