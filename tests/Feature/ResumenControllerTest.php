<?php

namespace Tests\Feature;

use App\Http\Controllers\DebtorController;
use App\User;
use Tests\TestCase;

class ResumenControllerTest extends TestCase
{

    public function testClass()
    {
        auth()->onceUsingId(20);
        $class = new DebtorController();
        $this->assertInstanceOf(DebtorController::class, $class);
        auth()->logout();
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/resumen');
        $response->assertViewIs('resumen');
    }
}
