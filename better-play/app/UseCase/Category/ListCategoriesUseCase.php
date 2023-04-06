<?php

namespace BetterPlay\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\ListCategory\ListCategoriesInputDTO;
use BetterPlay\UseCase\DTO\Category\ListCategory\ListCategoriesOutputDTO;

class ListCategoriesUseCase
{

    protected $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListCategoriesInputDTO $input): ListCategoriesOutputDTO
    {
        $categories = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new ListCategoriesOutputDTO(
            items: $categories->items(),
            total: $categories->total(),
            current_page: $categories->currentPage(),
            last_page: $categories->lastPage(),
            first_page: $categories->firstPage(),
            per_page: $categories->perPage(),
            to: $categories->to(),
            from: $categories->from(),
        );
    }
}
