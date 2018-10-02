<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class NotaControllerTest extends TestCase
{
    public function testIndexAdmin()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)
            ->get('/notadmin');
        $response->assertViewIs('notadmin');
    }

    public function testIndex()
    {
        $user = new User();
        $user->tipo = 'callcenter';
        $response = $this->actingAs($user)
            ->get('/notas/1');
        $response->assertViewIs('notas');
    }
}
