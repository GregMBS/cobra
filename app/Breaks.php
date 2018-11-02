<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Breaks
 * @package App
 * @method static find(int $auto)
 * @method static|Breaks whereGestor(string $agent)
 */
class Breaks extends Model
{
    protected $table = 'breaks';

    public $timestamps = false;

    protected $primaryKey = 'auto';
}
