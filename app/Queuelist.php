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
 * @method static where(string $column, string $operator, mixed $value)
 * @method static orderBy(string $column)
 */
class Queuelist extends Model
{
    protected $table = 'queuelist';
}
