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
        $this->actingAs($user)
            ->get('/bigproms/make');
        $this->assertFileExists(storage_path('temp.xlsx'));
        $this->assertFileIsReadable(storage_path('temp.xlsx'));
        Storage::delete('temp.xlsx');
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/bigproms');
        $response->assertViewIs('bigproms');
    }
}
