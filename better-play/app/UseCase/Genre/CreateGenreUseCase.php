<?php

namespace BetterPlay\UseCase\Genre;

use BetterPlay\Domain\Entity\Genre;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\GenreCreateInputDTO;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\GenreCreateOutputDTO;

class CreateGenreUseCase
{
    protected $repository;


    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GenreCreateInputDTO $input): GenreCreateOutputDTO
    {
        $entity = new Genre(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $newEntity = $this->repository->insert($entity);


        return new GenreCreateOutputDTO(
            id: $newEntity->id(),
            name: $newEntity->name,
            description: $newEntity->description,
            is_active: $newEntity->isActive,
            created_at: $newEntity->createdAt(),
        );
    }
}
