<?php
/**
 * Created by PhpStorm.
 * User: gmbs
 * Date: 9/12/18
 * Time: 5:46 PM
 */

namespace App;


class AgentDataClass
{
    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $initials;

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
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @param string $initials
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;
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
        $object->completo = $this->fullName;
        $object->iniciales = $this->initials;
        $object->pass = $this->pass;
        return $object;
    }
}