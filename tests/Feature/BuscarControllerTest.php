<?php

namespace Tests\Feature;

use App\Debtor;
use App\User;
use Tests\TestCase;

class BuscarControllerTest extends TestCase
{
    public function testSearch()
    {
        $user = User::first();
        $query = Debtor::first();
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
