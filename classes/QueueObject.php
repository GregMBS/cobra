<?php


namespace cobra_salsa;


class QueueObject
{
    /**
     * @var string
     */
    public string $cliente = '';

    /**
     * @var string
     */
    public string $sdc = '';

    /**
     * @var string
     */
    public string $status_aarsa = '';

    /**
     * @var int
     */
    public int $bloqueado;

    /**
     * @return string
     */
    public function getStatusAarsa(): string
    {
        if ($this->status_aarsa === '.') {
            return 'todos';
        }
        return $this->status_aarsa;
    }

    /**
     * @return string
     */
    public function getBloqueado(): string
    {
        if ($this->bloqueado === 1) {
            return "class='blocked'";
        }
        return '';
    }

}