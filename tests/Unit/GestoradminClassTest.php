<?php

namespace Tests\Unit;

use App\GestoradminClass;
use App\GestorDataClass;
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
            4 => 'pwd'
        );
        $gc = new GestoradminClass();
        $result = $gc->getNombres();
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
        $gc = new GestoradminClass();
        $result = $gc->getGroups();
        $this->assertEquals($test, $result);
    }

    /**
     * @param GestorDataClass $dataClass
     * @param int $howMany
     */
    private function checkUser(GestorDataClass $dataClass, $howMany)
    {
        $uc = new User();
        $data = $dataClass->getUser();
        /**
         * @var User $query
         */
        $query = $uc->whereIniciales($data->iniciales)
            ->whereCompleto($data->completo)
            ->whereTipo($data->tipo);
        $users = $query->get();
        $this->assertEquals($howMany, count($users));
    }

    public function testAddChangeDeleteUser()
    {
        $gc = new GestoradminClass();
        $data = new GestorDataClass();
        $data->setCompleto('Pedro Laskin');
        $data->setTipo('callcenter');
        $data->setIniciales('pedro');
        $data->setPass('AwRats');
        $gc->addUser($data);
        $this->checkUser($data,1);
        $data->setTipo('admin');
        $gc->changeUserData($data);
        $this->checkUser($data,1);
        $gc->removeUser('pedro');
        $this->checkUser($data,0);
    }
}
