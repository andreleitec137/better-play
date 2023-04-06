<?php

namespace BetterPlay\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\CategoryInputDTO;
use BetterPlay\UseCase\DTO\Category\DeleteCategory\CategoryDeleteOutputDTO;

class DeleteCategoryUseCase
{
    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryInputDTO $input): CategoryDeleteOutputDTO
    {
        $responseDelete = $this->repository->delete($input->id);

        return new CategoryDeleteOutputDTO(
            success: $responseDelete
        );
    }
}
