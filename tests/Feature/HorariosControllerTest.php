<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class HorariosControllerTest extends TestCase
{

    public function testShow()
    {
        $gestor = 'gregb';
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/horarios/' . $gestor);
        $response->assertViewIs('horario');
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/horarios');
        $response->assertViewIs('horarios');
    }

    public function testIndexV()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/horariosv');
        $response->assertViewIs('horariosV');
    }
}
