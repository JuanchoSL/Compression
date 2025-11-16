<?php

namespace JuanchoSL\Library\Tests;

use Exception;
use PHPUnit\Framework\TestCase;

class FunctionalTest extends TestCase
{

    public function testOk()
    {
        $this->assertTrue(true);
    }
    public function testException()
    {
        $this->expectException(Exception::class);
        throw new Exception("Launch exception");
    }
}