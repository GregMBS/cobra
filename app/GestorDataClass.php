<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 9/12/18
 * Time: 5:46 PM
 */

namespace App;


class GestorDataClass
{
    /**
     * @var string
     */
    private $completo;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $iniciales;

    /**
     * @var string
     */
    private $pass = '';

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @param string $completo
     */
    public function setCompleto($completo)
    {
        $this->completo = $completo;
    }

    /**
     * @param string $iniciales
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;
    }

    /**
     * @param string $pass
     */
    public function setPass($pass)
    {
        if (!empty($pass)) {
            $this->pass = $pass;
        }
    }

    /**
     * @return \stdClass
     */
    public function getUser()
    {
        /**
         * @var \stdClass $object
         * @property string $tipo
         * @property string $completo
         * @property string $iniciales
         * @property string $pass
         */
        $object = new \stdClass();
        $object->tipo = $this->tipo;
        $object->completo = $this->completo;
        $object->iniciales = $this->iniciales;
        $object->pass = $this->pass;
        return $object;
    }
}