<?php

namespace Tests\Feature;

use App\Http\Controllers\BestController;
use App\User;
use Exception;
use Storage;
use Tests\TestCase;

class BestControllerTest extends TestCase
{
    public function testIndexFromRoute()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/ultimo_mejor');
        $response->assertSeeText('XLSX');
    }

    public function testIndex()
    {
        $bc = new BestController();
        $this->expectException(Exception::class);
        $bc->index();
        $this->assertFileExists(storage_path('temp.xlsx'));
        $this->assertFileIsReadable(storage_path('temp.xlsx'));
        Storage::delete('temp.xlsx');
    }
}
