<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitAssignment
 * @package App
 * @property string $fechaIn
 * @method static|VisitAssignment whereCCont(int $id)
 * @method static|VisitAssignment whereNull(string $column)
 * @method static|VisitAssignment whereGestor(string $agent)
 * @method static|VisitAssignment whereFechaout(string $dateOut)
 */
class VisitAssignment extends Model
{
    protected $table = 'vasign';

    protected $primaryKey = 'auto';

    public $timestamps = false;
}
