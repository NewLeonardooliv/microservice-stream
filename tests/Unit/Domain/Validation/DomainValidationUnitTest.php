<?php

namespace Tests\Unit\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationUnitTest extends TestCase
{
    public function testNotNull()
    {
        $this->expectException(EntityValidationException::class);

        $value = '';
        DomainValidation::notNull($value);
    }

    public function testNotNullWithCustomMessageException()
    {
        try {
            $value = '';
            DomainValidation::notNull($value, 'Custom message exception');

            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th, 'Custom message exception');
        }
    }

    public function testStrMaxLength()
    {
        $this->expectException(EntityValidationException::class);
        
        $value = 'Test length so big';
        DomainValidation::strMaxLength($value, 5, 'Custom message exception');
    }

    public function testStrMinLength()
    {
        $this->expectException(EntityValidationException::class);

        $value = 'Do';
        DomainValidation::strMinLength($value, 2, 'Custom message exception');
    }

    public function testStrCanNullAndMaxLength()
    {
        $this->expectException(EntityValidationException::class);

        $value = 'teste';
        DomainValidation::strCanNullAndMaxLength($value, 2, 'Custom message exception');
    }
}
