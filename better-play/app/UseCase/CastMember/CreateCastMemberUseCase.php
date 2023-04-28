<?php

namespace BetterPlay\UseCase\CastMember;

use BetterPlay\Domain\Entity\CastMember;
use BetterPlay\Domain\Repository\CastMemberRepositoryInterface;
use BetterPlay\UseCase\DTO\CastMember\CreateCastMember\CastMemberCreateInputDTO;
use BetterPlay\UseCase\DTO\CastMember\CreateCastMember\CastMemberCreateOutputDTO;

class CreateCastMemberUseCase
{

    protected $repository;


    public function __construct(CastMemberRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CastMemberCreateInputDTO $input): CastMemberCreateOutputDTO
    {
        $CastMember = new CastMember(
            name: $input->name,
            type: $input->type,
        );

        $newCastMember = $this->repository->insert($CastMember);

        return new CastMemberCreateOutputDTO(
            id: $newCastMember->id(),
            name: $newCastMember->name,
            type: $newCastMember->type,
            createdAt: $newCastMember->createdAt(),
        );
    }
}
