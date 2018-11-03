<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Motive
 * @package App
 * @method static|Motive findOrFail(string $motive)
 */
class Motive extends Model
{
    protected $table = 'motivadores';

    protected $primaryKey = 'motiv';

    public $timestamps = false;
}
