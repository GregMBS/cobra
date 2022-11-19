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
    private $sm = 0;

    /**
     * @var float|null
     */
    private $smc = 0;

    /**
     * @return string
     */
    public function getCli(): string
    {
        if (empty($this->cli)) {
            return "";
        }
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
     * @return string
     */
    public function getSm(): string
    {
        if (empty($this->sm)) {
            return "0.00";
        }
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
     * @return string
     */
    public function getSmc(): string
    {
        if (empty($this->smc)) {
            return "0.00";
        }
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