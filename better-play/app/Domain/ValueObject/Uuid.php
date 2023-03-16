<?php

namespace BetterPlay\Domain\ValueObject;

use BetterPlay\Domain\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;


class Uuid
{

    public function __construct(
        protected string $id
    ) {
        $this->isValid($id);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }


    public function __toString(): string
    {
        return $this->id;
    }

    private function isValid(string $id)
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
