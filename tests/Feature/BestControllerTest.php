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
        $this->actingAs($user)
            ->get('/ultimo_mejor');
        $this->assertFileExists(storage_path('temp.xlsx'));
        $this->assertFileIsReadable(storage_path('temp.xlsx'));
        Storage::delete('temp.xlsx');
    }
}
