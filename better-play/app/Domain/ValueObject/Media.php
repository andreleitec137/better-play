<?php

namespace BetterPlay\Domain\ValueObject;

use BetterPlay\Domain\Enum\MediaStatus;

class Media
{

    public function __construct(
        protected string $filePath,
        protected MediaStatus $mediaStatus,
        protected string $encodedPath = '',
    ) {
    }

    public function __get($property)
    {
        return $this->{$property};
    }
}
