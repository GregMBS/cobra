<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Trouble
 * @package App
 * @method Trouble whereAuto(int $auto)
 * @property int $auto
 * @property string $fechacomp
 * @property string $it_guy
 * @property string $reparacion
 * @property string $sistema
 * @property string $usuario
 * @property string $fechahora
 * @property string $fuente
 * @property string $descripcion
 * @property string $error_msg
 */
class Trouble extends Model
{
    protected $table = 'trouble';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
