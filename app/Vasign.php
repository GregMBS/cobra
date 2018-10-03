<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Vasign
 * @package App
 * @property string $fechaIn
 * @method static|Vasign whereCCont(int $id_cuenta)
 * @method static|Vasign whereNull(string $column)
 * @method static|Vasign whereGestor(string $gestor)
 * @method static|Vasign whereFechaout(string $fechaout)
 */
class Vasign extends Model
{
    protected $table = 'vasign';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
