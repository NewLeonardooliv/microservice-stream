<?php

namespace Tests\Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class PrimeiroUnitTest extends TestCase
{
    public function testCallMethodTest()
    {
        $coreTest = new Teste();
        $response =$coreTest->test();

        $this->assertEquals('aaa', $response, 'Deve retornar uma string com "aaa"');
    }
}
