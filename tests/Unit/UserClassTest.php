<?php

namespace Tests\Unit;

use App\UserClass;
use Tests\TestCase;

class UserClassTest extends TestCase
{
    public function testListUsers()
    {
        $uc = new UserClass();
        $result = $uc->listUsers();
        $this->assertContains('gregb', $result);
    }

    public function testGetVisitadores()
    {
        $testKeys = [
            0 => 'iniciales',
            1 => 'completo'
        ];
        $uc = new UserClass();
        $result = $uc->getVisitadores();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testSetCamp()
    {
        $camp = 0;
        $capt = 'gregb';
        $uc = new UserClass();
        $uc->setCamp($camp, $capt);
        $this->assertDatabaseHas('users', [
            'iniciales' => $capt,
            'camp' => $camp
        ]);
    }
}
