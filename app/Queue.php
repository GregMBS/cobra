<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Queue
 * @package App
 * @method static whereCliente(string $client)
 * @method static whereGestor(string $agent)
 * @method static whereSdc(string $sdc)
 * @method static whereStatusAarsa(string $status)
 * @method static whereBloqueado(int $blocked)
 * @method static whereCamp(int $camp)
 * @method Queue orderBy(string $column)
 * @method Queue first(array $columns = ['*'])
 * @method Queue firstOrFail(array $columns = ['*'])
 */
class Queue extends Model
{
    protected $table = 'queuelist';
}
