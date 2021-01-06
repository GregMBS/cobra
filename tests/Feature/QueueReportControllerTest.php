<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class QueueReportControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/queuesqc');
        $response->assertViewIs('queuesqc');
    }
}
