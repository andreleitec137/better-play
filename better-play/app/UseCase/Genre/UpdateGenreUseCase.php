<?php

namespace BetterPlay\UseCase\Genre;

use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\UpdateGenre\GenreUpdateInputDTO;
use BetterPlay\UseCase\DTO\Genre\UpdateGenre\GenreUpdateOutputDTO;

class UpdateGenreUseCase
{
    protected $repository;

    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GenreUpdateInputDTO $input): GenreUpdateOutputDTO
    {
        $entity = $this->repository->findById($input->id);

        $entity->update(
            name: $input->name,
            description: $input->description ?? $entity->description,
        );

        $entityUpdated = $this->repository->update($entity);

        return new GenreUpdateOutputDTO(
            id: $entityUpdated->id,
            name: $entityUpdated->name,
            description: $entityUpdated->description,
            is_active: $entityUpdated->isActive,
            created_at: $entityUpdated->createdAt(),
        );
    }
}
