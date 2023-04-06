<?php

namespace BetterPlay\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\{CategoryInputDTO, CategoryOutputDTO};

class ListCategoryUseCase
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryInputDTO $input): CategoryOutputDTO
    {
        $category = $this->repository->findById($input->id);

        return new CategoryOutputDTO(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            is_active: $category->isActive,
            created_at: $category->createdAt(),
        );
    }
}
