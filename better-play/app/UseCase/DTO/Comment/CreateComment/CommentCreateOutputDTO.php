<?php

namespace BetterPlay\UseCase\DTO\Comment\CreateComment;

use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;

class CommentCreateOutputDTO
{
    public function __construct(
        public Uuid|string $id = '',
        public  bool $isActive = true,
        public $description = '',
        public DateTime|string $createdAt = '',
    ) {
    }

}
