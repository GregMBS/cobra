<?php

namespace App;


use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class CheckDataClass
{
    /**
     *
     * @var string
     */
    private $CUENTA;

    /**
     *
     * @var string
     */
    private $gestor;

    /**
     *
     * @var int
     */
    private $id_cuenta;

    /**
     *
     * @var string
     */
    private $tipo;

    /**
     *
     * @var Carbon
     */
    private $fechaOut;

    /**
     * @param Collection $r
     * @throws Exception
     */
    public function __construct(Collection $r)
    {
        $this->gestor = $r->gestor;
        $this->tipo = $r->tipo;
        $this->id_cuenta = $r->CUENTA;
        $this->CUENTA = $this->getCuentaFromIdCuenta($this->id_cuenta);
        if ($this->tipo == 'numero_de_cuenta') {
            $this->CUENTA = $r->CUENTA;
            $this->id_cuenta = $this->getIdCuentaFromCuenta($this->CUENTA);
        }
        try {
            $this->fechaOut = new Carbon($r->fechaout);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     *
     * @param string $cuenta
     * @return int
     */
    private function getIdCuentaFromCuenta($cuenta)
    {
        /**
         * @var Resumen|Builder $rc
         * @method Resumen whereNumeroDeCuenta($cuenta)
         */
        $rc = new Resumen();
        /** @var Resumen|Model $resumenStructure */
        $resumenStructure = $rc->whereNumeroDeCuenta($cuenta);
        /** @var Collection $resumen */
        $resumen = $resumenStructure->get();
        if ($resumen->count() > 0) {
            $cuenta = $resumen->first();
            return $cuenta->id_cuenta;
        }
        return 0;
    }

    /**
     *
     * @param int $id_cuenta
     * @return string
     */
    private function getCuentaFromIdCuenta($id_cuenta)
    {
        /**
         * @var Resumen $query
         * @method Resumen whereIdCuenta($id_cuenta)
         */
        $rc = new Resumen();
        /** @var Builder $query */
        $query = $rc->whereIdCuenta($id_cuenta);
        $resumen = $query->get();
        if (count($resumen) > 0) {
            $cuenta = $resumen->first();
            return $cuenta->numero_de_cuenta;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getCUENTA(): string
    {
        return $this->CUENTA;
    }

    /**
     * @return Carbon
     */
    public function getFechaOut(): Carbon
    {
        return $this->fechaOut;
    }

    /**
     * @return string
     */
    public function getGestor(): string
    {
        return $this->gestor;
    }

    /**
     * @return int
     */
    public function getIdCuenta(): int
    {
        return $this->id_cuenta;
    }

    /**
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }
}