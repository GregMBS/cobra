<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resumen
 * @package App
 * @method static whereIdCuenta(int $id_cuenta)
 * @method static whereNumeroDeCuenta(string $cuenta)
 * @method static whereEjecutivoAsignadoCallCenter(string $gestor)
 * @method static where(string $column, string $operator, mixed $value)
 */
class Resumen extends Model
{
    protected $table = 'resumen';
}
