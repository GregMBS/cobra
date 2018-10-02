<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RotasControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)->get('/rotas');
        $response->assertViewIs('rotas');
        $user = User::find(29);
        $response = $this->actingAs($user)->get('/rotas');
        $response->assertViewIs('rotas');
    }
}
