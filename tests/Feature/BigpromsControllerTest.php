<?php

namespace Tests\Feature;

use App\User;
use Storage;
use Tests\TestCase;

class BigpromsControllerTest extends TestCase
{
    public function testMakeReport()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigproms/make');
        if ($response->getContent()) {
            $this->assertRegExp('/XLSX/', $response->getContent());
        }
        $this->assertTrue(true);
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigproms');
        $response->assertViewIs('bigproms');
    }
}
