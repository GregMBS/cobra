<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class PagesTest extends TestCase
{
    private $reportUrls = [
        '/activar',
        '/bigproms',
        '/bigquery',
        '/breakAdmin',
        '/carga',
        '/changest',
        '/checkin',
        '/checkout',
        '/comparativo',
        '/gestoradmin',
        '/horario',
        '/horarios',
        '/horariosv',
        '/inactivar',
        '/intensidad',
        '/inventario',
        '/inventarioRapid',
        '/notadmin',
        '/pagobulk',
        '/pagosum',
        '/perfmes',
        '/perfmesv',
        '/queues',
        '/queuesqc',
        '/quick',
        '/resumen',
        '/rotas',
        '/segmento',
        '/ultimo_mejor'
    ];

    public function testReportsPages()
    {
        $user = User::whereTipo('admin')->first();
        foreach ($this->reportUrls as $url) {
            $response = $this->actingAs($user)
                ->get($url);
            if ($url !== '/ultimo_mejor') {
                $response->assertStatus(200);
            } else {
                $response->assertStatus(500);
            }
        }
    }
}
