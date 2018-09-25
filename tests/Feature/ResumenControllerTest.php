<?php

namespace Tests\Feature;

use App\Http\Controllers\ResumenController;
use App\User;
use Tests\TestCase;

class ResumenControllerTest extends TestCase
{

    public function testClass()
    {
        auth()->onceUsingId(20);
        $class = new ResumenController();
        $this->assertInstanceOf(ResumenController::class, $class);
        auth()->logout();
    }

    public function testIndex()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)->get('/resumen');
        $response->assertViewIs('resumen');
    }
}
