<?php

namespace BetterPlay\Domain\Entity;

use BetterPlay\Domain\Entity\Traits\EntityTraits;
use BetterPlay\Domain\Enum\CastMemberType;
use BetterPlay\Domain\Validation\DomainValidation;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;

class CastMember
{
    use EntityTraits;

    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected CastMemberType $type = CastMemberType::ACTOR,
        protected DateTime|string $createdAt = '',
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();

        DomainValidation::notNull($this->name);
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
    }

    public function update(
        string $name,
        CastMemberType $type
    ) {
        $this->name = $name;
        $this->type = $type;

        $this->validate();
    }

    public function validate()
    {
        DomainValidation::notNull($this->name);
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
    }
}
