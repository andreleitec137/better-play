<?php

namespace BetterPlay\Domain\Entity;

use BetterPlay\Domain\Entity\Traits\EntityTraits;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;

class Comment
{
    use EntityTraits;

    public function __construct(
        protected Uuid|string $id = '',
        protected string $description = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = '',
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
    }
}
