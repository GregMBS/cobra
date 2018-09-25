<?php

namespace Tests\Feature;

use App\User;
use Storage;
use Tests\TestCase;

class BestControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::find(20);
        $response = $this->actingAs($user)
            ->get('/ultimo_mejor');
        $response->assertStatus(200);
        $this->assertFileExists(storage_path('temp.xlsx'));
        $this->assertFileIsReadable(storage_path('temp.xlsx'));
        Storage::delete('temp.xlsx');
    }
}
