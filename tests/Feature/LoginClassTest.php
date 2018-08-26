<?php

namespace Tests\Feature;

use App\LoginClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginClassTest extends TestCase
{
    /**
     * @var LoginClass
     */
    private $lc;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetUserData()
    {
        $this->lc = new LoginClass();
        auth()->onceUsingId(1);
        $user = auth()->user();
        $userArray = $this->lc->getUserData($user);
        $this->assertArrayHasKey('id', $userArray);
        $this->assertTrue($userArray['id'] === 1);
    }

    public function testProcessLogin()
    {
        $this->lc = new LoginClass();
        $cookie = $this->lc->processLogin('gregb', '548823443', 'admin', '127.0.0.1');
        $this->assertStringStartsWith('gregb', $cookie);
    }
}
