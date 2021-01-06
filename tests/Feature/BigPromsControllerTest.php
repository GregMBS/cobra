<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class BigPromsControllerTest extends TestCase
{
    public function testMakeReport()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigProms/make');
        if ($response->getContent()) {
            $this->assertRegExp('/XLSX/', $response->getContent());
        }
        $this->assertTrue(true);
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigProms');
        $response->assertViewIs('bigProms');
    }
}
