<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class QueueReportControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)
            ->get('/queuesqc');
        $response->assertViewIs('queuesqc');
    }
}
