<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Resumen
 * @package App
 * @method static|Resumen whereIdCuenta(int $id_cuenta)
 * @method static|Resumen whereNumeroDeCuenta(string $cuenta)
 * @method static|Resumen whereEjecutivoAsignadoCallCenter(string $gestor)
 * @method static|Resumen whereStatusDeCredito(string $sdc)
 * @method static|Resumen find(int $id)
 * @method static|Resumen first()
 * @property int $id_cuenta
 */
class Resumen extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'resumen';

    protected $primaryKey = 'id_cuenta';

    public $timestamps = false;
}
