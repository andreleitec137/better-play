<?php

namespace BetterPlay\UseCase\Comment;

use BetterPlay\Domain\Entity\Comment;
use BetterPlay\Domain\Repository\CommentRepositoryInterface;
use BetterPlay\UseCase\DTO\Comment\CreateComment\CommentCreateInputDTO;
use BetterPlay\UseCase\DTO\Comment\CreateComment\CommentCreateOutputDTO;

class CreateCommentUseCase
{

    protected $repository;


    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CommentCreateInputDTO $input): CommentCreateOutputDTO
    {
        $Comment = new Comment(
            description: $input->description,
            isActive: $input->isActive,
        );

        $newComment = $this->repository->insert($Comment);

        return new CommentCreateOutputDTO(
            id: $newComment->id(),
            description: $newComment->description,
            isActive: $newComment->isActive,
            createdAt: $newComment->createdAt(),
        );
    }
}
