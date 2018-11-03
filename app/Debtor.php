<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Debtor
 * @package App
 * @method static|Debtor whereIdCuenta(int $id)
 * @method static|Debtor whereNumeroDeCuenta(string $account)
 * @method static|Debtor whereEjecutivoAsignadoCallCenter(string $agent)
 * @method static|Debtor whereStatusDeCredito(string $sdc)
 * @method static|Debtor find(int $id)
 * @method static|Debtor first()
 * @property int $id_cuenta
 */
class Debtor extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'resumen';

    protected $primaryKey = 'id_cuenta';

    public $timestamps = false;
}
