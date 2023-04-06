<?php

namespace BetterPlay\UseCase\DTO\Category\DeleteCategory;

class CategoryDeleteOutputDTO
{
    public function __construct(
        public bool $success
    ) {
    }
}
