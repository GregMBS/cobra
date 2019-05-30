<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RotasControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/rotas');
        $response->assertViewIs('rotas');
        $user = User::whereTipo('callcenter')->first();
        if ($user) {
            $response = $this->actingAs($user)->get('/rotas');
            $response->assertViewIs('rotas');
        }
    }
}
