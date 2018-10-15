<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{

    private $base = 'http://127.0.0.1:8000';

    private $reportUrls = [
        '/bigproms',
        '/bigquery',
        '/breakAdmin',
        '/carga',
        '/changest',
        '/checkin',
        '/checkout',
        '/comparativo',
        '/contactados',
        '/gestoradmin',
        '/horario',
        '/horarios',
        '/horariosv',
        '/inactivar',
        '/intensidad',
        '/inventario',
        '/inventarioRapid',
        '/marcados',
        '/notadmin',
        '/pagobulk',
        '/pagodet',
        '/pagosum',
        '/perfmes',
        '/perfmesv',
        '/queuemanual',
        '/queues',
        '/queuesqc',
        '/quick',
        '/quick',
        '/reporteManual',
        '/resumen',
        '/resumen',
        '/rotas',
        '/segmento',
        '/ultimo_mejor'
    ];

    /**
     * @throws \Throwable
     */
    public function testGetLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->base.'/login')
                ->assertSee('COBRA');
        });
    }

    /**
     * @throws \Throwable
     */
    public function testPostLogin()
    {
        $this->browse(function (Browser $browser) {
            $page = $browser->visit($this->base);
            $page->type('#iniciales', 'gregb');
            $page->type('#password', 'AwRats');
            $page->click('#go');
            $page->assertPathIs('/home');
            foreach ($this->reportUrls as $url) {
                $browser->visit($this->base . $url);
                $browser->assertDontSee('Error');
            }
        });
    }
}
