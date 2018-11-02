<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Historia
 * @package App
 * @method static|Historia whereCCvge($c_cvge)
 * @method static|Historia whereCCont($c_cont)
 * @method static|Historia whereDFech($d_fech)
 */
class Historia extends Model
{
    protected $table = 'historia';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
