<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param array $testKeys
     * @param array $result
     */
    protected function checkKeys(array $testKeys, array $result)
    {
        $this->assertGreaterThan(0, count($result));
        $first = $result[0];
        $keys = array_keys($first);
        $this->assertEquals($testKeys, $keys);
    }
}
