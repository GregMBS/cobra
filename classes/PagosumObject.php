<?php

namespace cobra_salsa;

class PagosumObject
{
    /**
     * @var string|null
     */
    private ?string $cli = "";

    /**
     * @var string|null
     */
    private ?string $sdc = "";

    /**
     * @var float|null
     */
    private ?float $sm = 0;

    /**
     * @var float|null
     */
    private ?float $smc = 0;

    /**
     * @return string
     */
    public function getCli(): string
    {
        return $this->cli;
    }

    /**
     * @param string $cli
     */
    public function setCli(string $cli): void
    {
        $this->cli = $cli;
    }

    /**
     * @return string
     */
    public function getSdc(): string
    {
        if (empty($this->sdc)) {
            return 'total';
        }
        return $this->sdc;
    }

    /**
     * @param string $sdc
     */
    public function setSdc(string $sdc): void
    {
        $this->sdc = $sdc;
    }

    /**
     * @return float
     */
    public function getSm(): float
    {
        return number_format($this->sm,2);
    }

    /**
     * @param float $sm
     */
    public function setSm(float $sm): void
    {
        $this->sm = $sm;
    }

    /**
     * @return float
     */
    public function getSmc(): float
    {
        return number_format($this->smc,2);
    }

    /**
     * @param float $smc
     */
    public function setSmc(float $smc): void
    {
        $this->smc = $smc;
    }

}