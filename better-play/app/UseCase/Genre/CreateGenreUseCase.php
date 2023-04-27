<?php

namespace BetterPlay\UseCase\Genre;

use BetterPlay\Domain\Entity\Genre;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\CreateGenreInputDTO;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\CreateGenreOutputDTO;

class CreateGenreUsecase
{

    protected $repository;


    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateGenreInputDTO $input): CreateGenreOutputDTO
    {
        $entity = new Genre(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $newEntity = $this->repository->insert($entity);

        return new CreateGenreOutputDTO(
            id: $newEntity->id(),
            name: $newEntity->name,
            description: $newEntity->description,
            is_active: $newEntity->isActive,
            created_at: $newEntity->createdAt(),
        );

    }

}
