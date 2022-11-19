<?php


namespace cobra_salsa;


class QueueObject
{
    /**
     * @var string
     */
    var string $cliente = '';

    /**
     * @var string
     */
    var string $sdc = '';

    /**
     * @var string
     */
    var string $status_aarsa = '';

    /**
     * @var int
     */
    var int $bloqueado;

    /**
     * @return string
     */
    public function getStatusAarsa(): string
    {
        if ($this->status_aarsa == '.') {
            return 'todos';
        }
        return $this->status_aarsa;
    }

    /**
     * @return string
     */
    public function getBloqueado(): string
    {
        if ($this->bloqueado == 1) {
            return "class='blocked'";
        }
        return '';
    }

}