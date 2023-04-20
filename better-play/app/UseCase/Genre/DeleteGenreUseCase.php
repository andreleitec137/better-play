<?php

namespace BetterPlay\UseCase\Genre;

use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\DeleteGenre\GenreDeleteOutputDTO;
use BetterPlay\UseCase\DTO\Genre\GenreInputDTO;

class DeleteGenreUseCase
{
    protected $repository;

    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GenreInputDTO $input): GenreDeleteOutputDTO
    {
        $responseDelete = $this->repository->delete($input->id);

        return new GenreDeleteOutputDTO(
            success: $responseDelete
        );
    }
}
