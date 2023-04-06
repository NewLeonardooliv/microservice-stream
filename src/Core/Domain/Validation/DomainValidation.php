<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use DomainException;

class DomainValidation extends DomainException
{
    public static function notNull(string $value, string $exceptionMessage = null)
    {
        if (is_null($value) || empty($value)) {
            throw new EntityValidationException($exceptionMessage ?? 'Shold not empty');
        }
    }

    public static function strMaxLength(string $value, int $length = 255, string $exceptionMessage = null)
    {
        if (strlen($value) >= $length) {
            throw new EntityValidationException($exceptionMessage ?? 'Shold not too biggest');
        }
    }

    public static function strMinLength(string $value, int $length = 2, string $exceptionMessage = null)
    {
        if (strlen($value) <= $length) {
            throw new EntityValidationException($exceptionMessage ?? 'Shold not too short');
        }
    }

    public static function strCanNullAndMaxLength(string $value = null, int $length = 255, $exceptionMessage = null)
    {
        if (!empty($value) && strlen($value) > $length) {
            throw new EntityValidationException($exceptionMessage ?? "The value most not be greater than {$length} characters");
        }
    }
}
