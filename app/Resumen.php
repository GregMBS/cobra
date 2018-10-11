<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resumen
 * @package App
 * @method static|Resumen whereIdCuenta(int $id_cuenta)
 * @method static|Resumen whereNumeroDeCuenta(string $cuenta)
 * @method static|Resumen whereEjecutivoAsignadoCallCenter(string $gestor)
 * @method static|Resumen whereStatusDeCredito(string $sdc)
 * @property int $id_cuenta
 */
class Resumen extends Model
{
    protected $table = 'resumen';

    public $timestamps = false;
}
