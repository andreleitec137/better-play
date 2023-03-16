<?php

namespace BetterPlay\Domain\Entity;

class Video
{
    use EntityTraits;

    public function __construct(
        protected string $id,
        protected string $title,
        protected string $description,
        protected int $yearLaunched,
        protected int $duration,
        protected bool $opened,
        protected int $rating,
        protected bool $published = false,
        protected string $thumbFile = '',
        protected string $thumbHalf = '',
        protected string $bannerFile = '',
        protected string $trailerFile = '',
        protected string $videoFile = ''

    ) {
    }
}
