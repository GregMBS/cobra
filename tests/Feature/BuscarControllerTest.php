<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class BuscarControllerTest extends TestCase
{
    public function testSearch()
    {
        $user = User::find(20);
        $request = [
            'field' => 'nombre_deudor',
            'find' => 'Maria'
        ];
        $response = $this->actingAs($user)
            ->json('GET', '/buscar', $request);
        $response->assertViewIs('buscar');
    }
}
