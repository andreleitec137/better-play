<?php

namespace BetterPlay\UseCase\DTO\Comment\CreateComment;

class CommentCreateInputDTO
{

    public function __construct(
        public string $description,
        public bool $isActive = true,
    ) {
    }

}
