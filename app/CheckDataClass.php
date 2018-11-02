<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class CheckDataClass
{
    /**
     *
     * @var string
     */
    private $account;

    /**
     *
     * @var string
     */
    private $agent;

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $tipo;

    /**
     *
     * @var Carbon
     */
    private $dateOut;

    /**
     * @param Collection $r
     */
    public function __construct(Collection $r)
    {
        $this->agent = $r->gestor;
        $this->tipo = $r->tipo;
        $this->id = $r->CUENTA;
        $this->account = $this->getAccountNumberFromId($this->id);
        if ($this->tipo == 'numero_de_cuenta') {
            $this->account = $r->CUENTA;
            $this->id = $this->getIdFromAccountNumber($this->account);
        }
        $this->dateOut = new Carbon($r->fechaout);
    }

    /**
     *
     * @param string $account
     * @return int
     */
    private function getIdFromAccountNumber($account)
    {
        /**
         * @var Resumen|Builder $rc
         * @method Resumen whereNumeroDeCuenta($account)
         */
        $rc = new Resumen();
        /** @var Builder|Resumen $query */
        $query = $rc->whereNumeroDeCuenta($account);
        $debtors = $query->get();
        if ($debtors->count() > 0) {
            $debtor = $debtors->first();
            return $debtor->id_cuenta;
        }
        return 0;
    }

    /**
     *
     * @param int $id
     * @return string
     */
    private function getAccountNumberFromId($id)
    {
        /**
         * @var Resumen $query
         * @method Resumen whereIdCuenta($id)
         */
        $rc = new Resumen();
        /** @var Builder $query */
        $query = $rc->whereIdCuenta($id);
        $debtors = $query->get();
        if ($debtors->count() > 0) {
            $debtor = $debtors->first();
            return $debtor->numero_de_cuenta;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * @return Carbon
     */
    public function getDateOut(): Carbon
    {
        return $this->dateOut;
    }

    /**
     * @return string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }
}