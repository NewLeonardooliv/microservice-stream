<?php

namespace Core\Domain\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(protected string $id)
    {
        $this->ensureIsValid();
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->id;
    }

    private function ensureIsValid()
    {
        if (!RamseyUuid::isValid($this->id)) {
            throw new InvalidArgumentException(sprintf('<%s>Does not allow the value<%s>.', static::class, $this->id));
        }
    }
}
