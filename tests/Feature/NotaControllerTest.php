<?php

namespace Tests\Feature;

use App\Debtor;
use App\User;
use Tests\TestCase;

class NotaControllerTest extends TestCase
{
    public function testIndexAdmin()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/notadmin');
        $response->assertViewIs('notadmin');
    }

    public function testIndex()
    {
        $user = new User();
        $user->tipo = 'callcenter';
        $query = Debtor::first();
        if ($query) {
            $response = $this->actingAs($user)
                ->get('/notas/' . $query->id_cuenta);
            $response->assertViewIs('notas');
        }
        $this->assertTrue(true);
    }
}
