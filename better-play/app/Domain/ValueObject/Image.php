<?php

namespace BetterPlay\Domain\ValueObject;

class Image
{

    public function __construct(
        protected string $filePath,
    ) {
    }

    public function __get($property)
    {
        return $this->{$property};
    }
}
