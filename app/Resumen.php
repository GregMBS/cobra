<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resumen
 * @package App
 * @method static whereIdCuenta(int $id_cuenta)
 * @method static whereNumeroDeCuenta(string $cuenta)
 * @method static whereEjecutivoAsignadoCallCenter(string $gestor)
 * @method static whereStatusDeCredito(string $sdc)
 */
class Resumen extends Model
{
    protected $table = 'resumen';

    public $timestamps = false;
}
