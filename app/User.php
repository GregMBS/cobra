<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string completo 
 * @property string iniciales 
 * @property int camp 
 * @property string tipo
 * @method  User whereIniciales(string $iniciales)
 * @method  User whereCompleto(string $completo)
 * @method  static|User whereTipo(string $tipo)
 * @method  User first()
 * @author gmbs
 *
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
