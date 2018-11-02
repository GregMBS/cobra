<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string completo 
 * @property string iniciales 
 * @property int camp 
 * @property string tipo
 * @method  static|User whereIniciales(string $initials)
 * @method  User whereCompleto(string $fullName)
 * @method  static|User whereTipo(string $type)
 * @method  static|User first()
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
