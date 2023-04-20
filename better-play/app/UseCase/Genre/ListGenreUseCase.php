<?php

namespace BetterPlay\UseCase\Genre;

use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\GenreInputDTO;
use BetterPlay\UseCase\DTO\Genre\GenreOutputDTO;

class ListGenreUseCase
{

    protected $repository;

    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GenreInputDTO $input): GenreOutputDTO
    {
        $category = $this->repository->findById($input->id);

        return new GenreOutputDTO(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive,
            created_at: $category->createdAt(),
        );
    }
}
