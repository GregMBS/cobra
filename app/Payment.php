<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * @package App
 * @method static|Payment whereIdCuenta(int $id)
 * @method static|Payment whereFecha(string $date)
 */
class Payment extends Model
{
    protected $table = 'pagos';
}
