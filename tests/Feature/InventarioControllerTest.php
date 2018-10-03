<?php

namespace Tests\Feature;

use App\Resumen;
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
        $cuenta = Resumen::where('status_de_credito', 'NOT REGEXP', '-')->first();
        $data = ['cliente' => $cuenta->cliente];
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->post('/inventario', $data);
        $response->assertStatus(500);
    }

    public function testMakeReportRapid()
    {
        $cuenta = Resumen::where('status_de_credito', 'NOT REGEXP', '-')->first();
        $data = ['cliente' => $cuenta->cliente];
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->post('/inventarioRapid', $data);
        $response->assertStatus(500);
    }
}
