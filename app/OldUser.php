<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OldUser
 * @package App
 * @method static|OldUser wherePass(string $sha1)
 * @method static|OldUser where(string $column, string $operator, mixed $value)
 */
class OldUser extends Model
{
    protected $table = 'nombres';

    public $timestamps = false;
}
