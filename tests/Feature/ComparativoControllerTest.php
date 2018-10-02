<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class ComparativoControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/comparativo');
        $response->assertViewIs('comparativo');
    }
}
