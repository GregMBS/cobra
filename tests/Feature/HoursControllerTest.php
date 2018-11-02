<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class HoursControllerTest extends TestCase
{

    protected $urlStub = 'hour';

    public function testShow()
    {
        $gestor = 'gregb';
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/'.$this->urlStub.'s/' . $gestor);
        $response->assertViewIs($this->urlStub);
    }

    public function testIndex()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/'.$this->urlStub.'s');
        $response->assertViewIs($this->urlStub.'s');
    }

    public function testIndexV()
    {
        $user = User::whereTipo('admin')->first();
        $response = $this->actingAs($user)->get('/'.$this->urlStub.'sv');
        $response->assertViewIs($this->urlStub.'sV');
    }
}
