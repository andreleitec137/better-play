<?php

namespace BetterPlay\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\UpdateCategory\CategoryUpdateInputDTO;
use BetterPlay\UseCase\DTO\Category\UpdateCategory\CategoryUpdateOutputDTO;

class UpdateCategoryUseCase
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryUpdateInputDTO $input): CategoryUpdateOutputDto
    {
        $category = $this->repository->findById($input->id);

        $category->update(
            name: $input->name,
            description: $input->description ?? $category->description,
        );

        $categoryUpdated = $this->repository->update($category);

        return new CategoryUpdateOutputDTO(
            id: $categoryUpdated->id,
            name: $categoryUpdated->name,
            description: $categoryUpdated->description,
            is_active: $categoryUpdated->isActive,
            created_at: $categoryUpdated->createdAt(),
        );
    }
}
