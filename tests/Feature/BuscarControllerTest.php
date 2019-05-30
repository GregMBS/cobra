<?php

namespace Tests\Feature;

use App\Resumen;
use App\User;
use Tests\TestCase;

class BuscarControllerTest extends TestCase
{
    public function testSearch()
    {
        $user = User::first();
        $query = Resumen::first();
        if ($query) {
            $request = [
                'field' => 'nombre_deudor',
                'find' => $query->nombre_deudor,
                'cliente' => $query->cliente
            ];
            $response = $this->actingAs($user)
                ->json('GET', '/buscar', $request);
            $response->assertViewIs('buscar');
        }
        $this->assertTrue(true);
    }
}
