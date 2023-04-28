<?php

namespace BetterPlay\UseCase\DTO\CastMember\CreateCastMember;

use BetterPlay\Domain\Enum\CastMemberType;

class CastMemberCreateInputDTO
{

    public function __construct(
        public string $name,
        public CastMemberType $type = CastMemberType::ACTOR,
    ) {
    }

}
