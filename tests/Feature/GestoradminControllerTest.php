<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GestoradminControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/gestoradmin');
        $response->assertViewIs('gestoradmin');
    }

    public function testAddChangeDeleteUser()
    {
        $user = User::whereTipo('admin')->first();
        $test = [
            'iniciales' => 'pedro',
            'completo' => 'Pedro Laskin',
            'tipo' => 'admin',
            'passw' => 'AwRats'
        ];
        $short = $test;
        unset($short['passw']);
        $response = $this->actingAs($user)->post('/gestor/add', $test);
        $response->assertViewIs('gestoradmin');
        $this->assertDatabaseHas('users', $short);
        $test['tipo'] = 'callcenter';
        $test['passw'] = 'AwMice';
        $short['tipo'] = 'callcenter';
        $response = $this->actingAs($user)->post('/gestor/change', $test);
        $response->assertViewIs('gestoradmin');
        $response = $this->actingAs($user)->post('/gestor/delete', $test);
        $response->assertViewIs('gestoradmin');
        $response->assertDontSee('Pedro Laskin');
    }

}
