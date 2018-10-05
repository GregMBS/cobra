<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Motivador
 * @package App
 * @method static|Motivador findOrFail(string $motiv)
 */
class Motivador extends Model
{
    protected $table = 'motivadores';

    protected $primaryKey = 'motiv';

    public $timestamps = false;
}
