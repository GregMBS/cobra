<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Historia
 * @package App
 * @method Historia whereCCvge($c_cvge)
 * @method Historia whereCCont($c_cont)
 * @method Historia whereDFech($d_fech)
 */
class Historia extends Model
{
    protected $table = 'historia';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
