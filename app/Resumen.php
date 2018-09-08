<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Resumen
 * @package App
 * @method static whereIdCuenta(int $id_cuenta)
 * @method static whereNumeroDeCuenta(string $cuenta)
 */
class Resumen extends Model
{
    protected $table = 'resumen';
}
