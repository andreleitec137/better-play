<?php

namespace BetterPlay\UseCase\DTO\Video\CreateVideo;

use BetterPlay\Domain\Enum\Censure;
use BetterPlay\Domain\ValueObject\Image;
use BetterPlay\Domain\ValueObject\Media;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;

class VideoCreateOutputDTO
{
    public function __construct(
        public Uuid|string $id = '',
        public string $title = '',
        public string $description = '',
        public int $yearLaunched = 0,
        public int $duration = 0,
        public bool $opened = false,
        public int  $rating = 0,
        public Censure $censure = Censure::L,
        public bool $published = false,
        public DateTime|string $createdAt = '',
        public ?Image $thumbFile = null,
        public ?Image $thumbHalf = null,
        public ?Image $bannerFile = null,
        public ?Media $trailerFile = null,
        public ?Media $videoFile = null,
    ) {
    }

}
