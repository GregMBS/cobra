<?php

namespace Tests\Unit;

use App\GestionClass;
use Tests\TestCase;
use Faker;

class GestionClassTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddNewTel()
    {
        $gc = new GestionClass();
        $newTel = '8888888888';
        $result = $gc->addNewTel(100, $newTel);
        $this->assertEquals($newTel, $result['tel_1_verif']);
    }

}
