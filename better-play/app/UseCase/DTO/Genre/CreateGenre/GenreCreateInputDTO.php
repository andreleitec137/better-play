<?php

namespace BetterPlay\UseCase\DTO\Genre\CreateGenre;

class GenreCreateInputDTO
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) {
    }
}
