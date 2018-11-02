<?php

namespace Tests\Unit;

use App\AgentAdminClass;
use App\AgentDataClass;
use App\User;
use Tests\TestCase;

class GestoradminClassTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetNombres()
    {
        $testKeys = Array(
            0 => 'completo',
            1 => 'tipo',
            2 => 'camp',
            3 => 'iniciales',
            4 => 'pwd',
            5 => 'name'
        );
        $gc = new AgentAdminClass();
        $result = $gc->getNames();
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }

    public function testGetGroups()
    {
        $test = Array(
            0 => 'admin',
            1 => 'callcenter',
            2 => 'visitador',
            3 => 'abogado',
            4 => 'promo'
        );
        $gc = new AgentAdminClass();
        $result = $gc->getGroups();
        $this->assertEquals($test, $result);
    }

    /**
     * @param AgentDataClass $dataClass
     */
    private function hasUser(AgentDataClass $dataClass)
    {
        $data = $dataClass->getUser();
        $this->assertDatabaseHas('users', [
            'iniciales' => $data->iniciales,
            'completo' => $data->completo,
            'tipo' => $data->tipo
        ]);
    }

    /**
     * @param AgentDataClass $dataClass
     */
    private function noUser(AgentDataClass $dataClass)
    {
        $data = $dataClass->getUser();
        $this->assertDatabaseMissing('users', [
            'iniciales' => $data->iniciales,
            'completo' => $data->completo,
            'tipo' => $data->tipo
        ]);
    }

    public function testAddChangeDeleteUser()
    {
        $gc = new AgentAdminClass();
        $data = new AgentDataClass();
        $data->setFullName('Pedro Laskin');
        $data->setTipo('admin');
        $data->setInitials('pedro');
        $data->setPass('AwRats');
        $gc->addUser($data);
        $this->hasUser($data);
        $data->setTipo('callcenter');
        $gc->changeUserData($data);
        $this->hasUser($data);
        $gc->removeUser('pedro');
        $this->noUser($data);
    }
}
