<?php

namespace BetterPlay\UseCase\Genre;


use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\UseCase\DTO\Genre\ListGenre\ListGenresInputDTO;
use BetterPlay\UseCase\DTO\Genre\ListGenre\ListGenresOutputDTO;

class ListGenresUseCase
{

    protected $repository;

    public function __construct(GenreRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ListGenresInputDTO $input): ListGenresOutputDTO
    {
        $entities = $this->repository->paginate(
            filter: $input->filter,
            order: $input->order,
            page: $input->page,
            totalPage: $input->totalPage,
        );

        return new ListGenresOutputDTO(
            items: $entities->items(),
            total: $entities->total(),
            current_page: $entities->currentPage(),
            last_page: $entities->lastPage(),
            first_page: $entities->firstPage(),
            per_page: $entities->perPage(),
            to: $entities->to(),
            from: $entities->from(),
        );
    }
}
