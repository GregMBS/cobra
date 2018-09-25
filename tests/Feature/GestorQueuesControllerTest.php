<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class GestorQueuesControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)->get('/queuesg');
        $response->assertViewIs('queuesg');
    }
}
