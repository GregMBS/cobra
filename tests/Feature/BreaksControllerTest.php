<?php

namespace Tests\Feature;

use App\Breaks;
use App\User;
use Tests\TestCase;

class BreaksControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/breaks/gregb');
        $response->assertViewIs('breaks');
    }

    public function testAdmIndex()
    {
        $response = $this->get('/breakAdmin');
        $response->assertRedirect('/login');
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/breakAdmin');
        $response->assertViewIs('breakAdmin');
    }

    public function testAgregarCambiarBorrar()
    {
        $user = User::whereTipo('admin')->first();
        $data = [
            'gestor' => 'gregb',
            'tipo' => 'break',
            'empieza' => '12:00',
            'termina' => '13:00'
        ];
        $response = $this->actingAs($user)->post('/breakAdmin', $data);
        $response->assertSee('gregb');
        $break = Breaks::whereGestor('gregb')->first();
        $id = $break->auto;
        $update = [
            'auto' => $id,
            'tipo' => 'bano',
            'empieza' => '11:30',
            'termina' => '12:00'
        ];
        $response = $this->actingAs($user)->put('/breakAdmin', $update);
        $response->assertSee('11:30');
        $response = $this->actingAs($user)->delete('/breakAdmin/'. $id);
        $response->assertDontSee('11:30');
    }

}
