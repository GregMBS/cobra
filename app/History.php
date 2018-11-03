<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package App
 * @method static|History whereCCvge(string $agent)
 * @method static|History whereCCont(int $id)
 * @method static|History whereDFech(string $date)
 */
class History extends Model
{
    protected $table = 'historia';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
