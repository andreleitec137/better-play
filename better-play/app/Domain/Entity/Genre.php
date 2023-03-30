<?php

namespace BetterPlay\Domain\Entity;

use BetterPlay\Domain\Entity\Traits\EntityTraits;
use BetterPlay\Domain\ValueObject\Uuid;
use DateTime;
use Exception;

class Genre
{
    use EntityTraits;

    protected array $categoriesId = [];

    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
        protected DateTime|string $createdAt = '',
    ) {
        $this->id = $this->id ? new Uuid($this->id) : Uuid::random();
        $this->createdAt = $this->createdAt ? new DateTime($this->createdAt) : new DateTime();
    }

    public function update(string $name = '', string $description = ''): void
    {
        $this->name = $name;
        $this->description = $description;
    }


    public function addCategoryId(string $categoryId)
    {
        array_push($this->categoriesId, $categoryId);
    }

    public function removeCategoryId(string $categoryId)
    {
        unset($this->categoriesId[array_search($categoryId, $this->categoriesId)]);
    }


    public function validate(): void
    {

        if (!$this->name) throw new Exception("Invalid Entity: name not found!");

        if (strlen($this->name) > 255) throw new Exception("Invalid Entity: The value must not be greater than 255");

        if (strlen($this->name) <= 3) throw new Exception("Invalid Entity: The value must not be least than 3");
    }
}
