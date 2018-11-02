<?php

namespace Tests\Feature;

use App\User;
use Storage;
use Tests\TestCase;

class BigQueryControllerTest extends TestCase
{
    public function testMakeReport()
    {
        $user = User::whereTipo('admin')->first();
        $response=$this->actingAs($user)
            ->get('/bigQuery/make');
        $this->assertRegExp('/XLSX/', $response->getContent());
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigQuery');
        $response->assertViewIs('bigQuery');
    }
}
