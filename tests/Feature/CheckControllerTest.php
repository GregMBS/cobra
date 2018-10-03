<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class CheckControllerTest extends TestCase
{
    public function testGetPages()
    {
        /** @var User $user */
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/checkout');
        $response->assertViewIs('checkout');
        $response = $this->actingAs($user)->get('/checkin');
        $response->assertViewIs('checkIn');
        $response = $this->actingAs($user)->get('/checkboth');
        $response->assertViewIs('checkBoth');
    }

    public function testGetVisitadores()
    {
        /** @var User $user */
        $user = User::whereTipo('admin')->first();
        /** @var User $visitador */
        $visitador = User::whereTipo('visitador')->first();
        if ($visitador) {
            $name = $visitador->iniciales;
        } else {
            $name = $user->iniciales;
        }
        $response = $this->actingAs($user)->get('/checkout/' . $name);
        $response->assertViewIs('checkout');
        $response = $this->actingAs($user)->get('/checkin/' . $name);
        $response->assertViewIs('checkIn');
        $response = $this->actingAs($user)->get('/checkboth/' . $name);
        $response->assertViewIs('checkBoth');
        $response = $this->actingAs($user)->get('/checkoutlist/' . $name);
        $response->assertViewIs('checkOutList');
    }
}
