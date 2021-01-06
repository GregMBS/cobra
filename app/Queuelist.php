<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Queuelist
 * @package App
 * @method static whereCliente(string $cliente)
 * @method static whereGestor(string $gestor)
 * @method static whereSdc(string $sdc)
 * @method static whereStatusAarsa(string $status)
 * @method static whereBloqueado(int $bloqueado)
 * @method static whereCamp(int $camp)
 * @method Queuelist orderBy(string $column)
 * @method Queuelist first(array $columns = ['*'])
 * @method Queuelist firstOrFail(array $columns = ['*'])
 * @method static where(string $string, string $string1, string $string2)
 */
class Queuelist extends Model
{
    protected $table = 'queuelist';
}
