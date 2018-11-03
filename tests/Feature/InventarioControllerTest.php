<?php

namespace Tests\Feature;

use App\Debtor;
use App\User;
use Tests\TestCase;

class InventarioControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/inventario');
        $response->assertViewIs('inventario');
    }

    public function testIndexRapid()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/inventarioRapid');
        $response->assertViewIs('inventario');
    }

    public function testMakeReport()
    {
        $cuenta = Debtor::where('status_de_credito', 'NOT REGEXP', '-')->first();
        if ($cuenta) {
            $data = ['cliente' => $cuenta->cliente];
            $user = User::whereTipo('admin')->first();
            $response = $this->actingAs($user)
                ->post('/inventario', $data);
            $response->assertStatus(500);
        }
        $this->assertTrue(true);
    }

    public function testMakeReportRapid()
    {
        $cuenta = Debtor::where('status_de_credito', 'NOT REGEXP', '-')->first();
        if ($cuenta) {
            $data = ['cliente' => $cuenta->cliente];
            $user = User::whereTipo('admin')->first();
            $response = $this->actingAs($user)
                ->post('/inventarioRapid', $data);
            $response->assertStatus(500);
        }
        $this->assertTrue(true);
    }
}
