<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class IntensidadControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->get('/intensidad');
        $response->assertViewIs('intensidad');
    }

    public function testMakeReport()
    {
        $from = date('Y-m-d', strtotime('1 month ago'));
        $to = date('Y-m-d');
        $data = ['fecha1' => $from, 'fecha2' => $to];
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)
            ->post('/intensidad', $data);
        $response->assertStatus(500);
    }
}
