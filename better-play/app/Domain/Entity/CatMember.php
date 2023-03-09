<?php

use BetterPlay\Domain\Entity;

class CatMember
{
    use EntityTraits;

    public function __construct(
        protected string $id,
        protected string $name,
        protected string $CatMemberType
    ) {
    }
}
