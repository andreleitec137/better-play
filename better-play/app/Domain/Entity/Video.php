<?php

namespace BetterPlay\Domain\Entity;

use BetterPlay\Domain\Entity\Traits\EntityTraits;
use BetterPlay\Domain\Enum\Censure;
use BetterPlay\Domain\ValueObject\Image;
use BetterPlay\Domain\ValueObject\Media;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;
use Exception;

class Video
{
    use EntityTraits;

    protected array $categoriesId = [];

    protected array $genresId = [];

    protected array $castMemberIds = [];

    protected array $commentsId = [];

    public function __construct(
        protected Uuid|string $id = '',
        protected string $title = '',
        protected string $description = '',
        protected int $yearLaunched = 0,
        protected int $duration = 0,
        protected bool $opened = false,
        protected int  $rating = 0,
        protected Censure $censure = Censure::L,
        protected bool $published = false,
        protected DateTime|string $createdAt = '',
        protected ?Image $thumbFile = null,
        protected ?Image $thumbHalf = null,
        protected ?Image $bannerFile = null,
        protected ?Media $trailerFile = null,
        protected ?Media $videoFile = null,
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
    }

    public function update(
        string $title,
        string $description,
        int $yearLaunched,
        int $duration,
        bool $opened,
        int  $rating,
        Censure $censure,
        bool $published,

    ) {
        $this->title = $title;
        $this->description = $description;
        $this->yearLaunched = $yearLaunched;
        $this->duration = $duration;
        $this->opened = $opened;
        $this->rating = $rating;
        $this->censure = $censure;
        $this->published = $published;
    }


    public function addCategoryId(string $categoryId)
    {
        array_push($this->categoriesId, $categoryId);
    }

    public function removeCategoryId(string $categoryId)
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);
    }

    public function addGenreId(string $genreId)
    {
        array_push($this->genresId, $genreId);
    }

    public function removeGenreId(string $genreId)
    {
        unset($this->genresId[array_search($genreId, $this->genresId)]);
    }

    public function addCastMemberId(string $castMemberId)
    {
        array_push($this->castMemberIds, $castMemberId);
    }

    public function removeCastMemberId(string $castMemberId)
    {
        unset($this->castMemberIds[array_search($castMemberId, $this->castMemberIds)]);
    }

    public function addCommentId(string $commentId)
    {
        array_push($this->commentsId, $commentId);
    }

    public function removeCommentId(string $commentId)
    {
        unset($this->commentsId[array_search($commentId, $this->commentsId)]);
    }

    public function thumbFile(): ?Image
    {
        return $this->thumbFile;
    }

    public function setThumbFile(Image $thumbFile): void
    {
        $this->thumbFile = $thumbFile;
    }

    public function thumbHalf(): ?Image
    {
        return $this->thumbHalf;
    }

    public function setThumbHalf(Image $thumbHalf): void
    {
        $this->thumbHalf = $thumbHalf;
    }

    public function bannerFile(): ?Image
    {
        return $this->bannerFile;
    }

    public function trailerFile(): ?Media
    {
        return $this->trailerFile;
    }


    public function videoFile(): ?Media
    {
        return $this->videoFile;
    }


    public function validate(): void
    {

        if (!$this->title) throw new Exception("Invalid Entity: name not found!");
        if (strlen($this->title) > 255) throw new Exception("Invalid Entity: The value must not be greater than 255");
        if (strlen($this->title) <= 3) throw new Exception("Invalid Entity: The value must not be least than 3");
    }
}
