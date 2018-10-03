<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
        $this->fechaOut = new Carbon($r->fechaout);
    }

    /**
     *
     * @param string $cuenta
     * @return int
     */
    private function getIdCuentaFromCuenta($cuenta)
    {
        /**
         * @var Resumen|\Illuminate\Database\Eloquent\Collection $resumen
         * @method Resumen whereNumeroDeCuenta($cuenta)
         */
        $rc = new Resumen();
        $resumen = $rc->whereNumeroDeCuenta($cuenta)
            ->where('status_de_credito', 'NOT REGEXP', '-')->get();
        if (count($resumen) > 0) {
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
        $query = $query->where('status_de_credito', 'NOT REGEXP', '-');
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