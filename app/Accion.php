<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Accion
 * @package App
 * @method static|Accion find(string $accion)
 */
class Accion extends Model
{
    protected $table = 'acciones';

    public $timestamps = false;
}
