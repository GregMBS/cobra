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
    private $gestor;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $empieza;

    /**
     * @var string
     */
    private $termina;

    /**
     * @param int $auto
     */
    public function setAuto($auto)
    {
        $this->auto = $auto;
    }

    /**
     * @param string $empieza
     */
    public function setEmpieza($empieza)
    {
        $this->empieza = $empieza;
    }

    /**
     * @param string $gestor
     */
    public function setGestor($gestor)
    {
        $this->gestor = $gestor;
    }

    /**
     * @param string $termina
     */
    public function setTermina($termina)
    {
        $this->termina = $termina;
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
        $object->empieza = $this->empieza;
        $object->gestor = $this->gestor;
        $object->termina = $this->termina;
        $object->tipo = $this->tipo;
        return $object;
    }
}