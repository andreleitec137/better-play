<?php

namespace BetterPlay\UseCase\DTO\CastMember\CreateCastMember;

use BetterPlay\Domain\Enum\CastMemberType;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;

class CastMemberCreateOutputDTO
{
    public function __construct(
        public Uuid|string $id = '',
        public string $name = '',
        public CastMemberType $type = CastMemberType::ACTOR,
        public DateTime|string $createdAt = '',
    ) {
    }

}
