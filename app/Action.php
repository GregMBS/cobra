<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Action
 * @package App
 * @method static|Action whereAccion(string $action)
 * @property string $accion
 */
class Action extends Model
{
    protected $table = 'acciones';

    public $timestamps = false;
}
