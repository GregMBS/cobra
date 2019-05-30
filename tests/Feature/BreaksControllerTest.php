<?php

namespace Tests\Feature;

use App\Breaks;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
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

    public function testAddChangeBorrar()
    {
        $user = User::whereTipo('admin')->first();
        $data = [
            'gestor' => $user->iniciales,
            'tipo' => 'break',
            'start' => '12:00',
            'finish' => '13:00'
        ];
        $response = $this->actingAs($user)->post('/breakAdmin', $data);
        $response->assertSee($user->iniciales);
        /** @var Builder $query */
        $query = Breaks::whereGestor($user->iniciales);
        $breaks = $query->get();
        /** @var Breaks $break */
        $break = $breaks->first();
        $id = $break->auto;
        $update = [
            'auto' => $id,
            'tipo' => 'bano',
            'start' => '11:30',
            'finish' => '12:00'
        ];
        $response = $this->actingAs($user)->put('/breakAdmin', $update);
        $response->assertSee('11:30');
        $response = $this->actingAs($user)->delete('/breakAdmin/'. $id);
        $response->assertDontSee('11:30');
    }

}
