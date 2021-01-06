<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Historia
 * @package App
 * @method static|Historia whereCCvge($c_cvge)
 * @method Historia whereCCont($c_cont)
 * @method Historia whereDFech($d_fech)
 * @method static where(string $string, string $string1, int $int)
 * @method static join(string $string, string $string1, string $string2, string $string3)
 * @method static whereBetween(string $string, array $array)
 */
class Historia extends Model
{
    protected $table = 'historia';

    protected $primaryKey = 'auto';

//    public $timestamps = false;
}
