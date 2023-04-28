<?php

namespace BetterPlay\Domain\Repository;

use BetterPlay\Domain\Entity\Video;

interface VideoRepositoryInterface
{

    public function insert(Video $video): Video;

    public function findById(string $videoId): Video;

    public function getIdsListIds(array $videosIds = []): array;

    public function findAll(string $filter = '', $order = 'DESC'): array;

    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): PaginationInterface;

    public function update(Video $video): Video;

    public function delete(string $videoId): bool;
}
