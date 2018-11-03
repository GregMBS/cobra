<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Status
 * @package App
 * @method static|Status whereDictamen(string $status)
 * @property string $dictamen
 */
class Status extends Model
{
    protected $table = 'dictamenes';
}
