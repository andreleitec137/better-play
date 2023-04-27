<?php

namespace BetterPlay\UseCase\Category;

use BetterPlay\Domain\Entity\Category;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDTO;
use BetterPlay\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDTO;

class CreateCategoryUseCase
{

    protected $repository;


    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CategoryCreateInputDTO $input): CategoryCreateOutputDTO
    {
        $category = new Category(
            name: $input->name,
            description: $input->description,
            isActive: $input->isActive,
        );

        $newCategory = $this->repository->insert($category);

        return new CategoryCreateOutputDTO(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $newCategory->description,
            is_active: $newCategory->isActive,
            created_at: $newCategory->createdAt(),
        );
    }
}
