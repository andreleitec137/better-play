<?php

namespace BetterPlay\Domain\Repository;

use BetterPlay\Domain\Entity\Comment;

interface CommentRepositoryInterface
{

    public function insert(Comment $comment): Comment;

    public function findById(string $commentId): Comment;

    public function getIdsListIds(array $commentsIds = []): array;

    public function findAll(string $filter = '', $order = 'DESC'): array;

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;

    public function update(Comment $comment): Comment;

    public function delete(string $commentId): bool;
}
