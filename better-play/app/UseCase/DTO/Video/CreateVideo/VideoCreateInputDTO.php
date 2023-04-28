<?php

namespace BetterPlay\UseCase\DTO\Video\CreateVideo;

use BetterPlay\Domain\Enum\Censure;
use BetterPlay\Domain\Enum\VideoType;
use BetterPlay\Domain\ValueObject\Image;
use BetterPlay\Domain\ValueObject\Media;

class VideoCreateInputDTO
{

    public function __construct(
        public string $title = '',
        public string $description = '',
        public int $yearLaunched = 0,
        public int $duration = 0,
        public int  $rating = 0,
        public Censure $censure = Censure::L,
        public ?Image $thumbFile = null,
        public ?Image $thumbHalf = null,
        public ?Image $bannerFile = null,
        public ?Media $trailerFile = null,
        public ?Media $videoFile = null,
    ) {
    }

}
