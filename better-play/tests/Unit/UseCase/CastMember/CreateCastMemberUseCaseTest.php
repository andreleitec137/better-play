<?php

namespace Tests\BetterPlay\Unit\UseCase\CastMember;


use BetterPlay\Domain\Entity\CastMember as EntityCastMember;
use BetterPlay\Domain\Enum\CastMemberType;
use BetterPlay\Domain\Repository\CastMemberRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\CastMember\CreateCastMemberUseCase;
use BetterPlay\UseCase\DTO\CastMember\CreateCastMember\{CastMemberCreateInputDTO, CastMemberCreateOutputDTO};
use Mockery;
use Mockery\MockInterface;
use stdClass;
use Tests\TestCase;

class CreateCastMemberUseCaseTest extends TestCase
{

    public function test_CreateNewCastMember()
    {
        $uuid = (string) Uuid::random();
        $CastMemberName = 'André Leite';
        $CastMemberType = CastMemberType::ACTOR;


        /** @var MockInterface $mockEntity */
        $mockEntity = Mockery::mock(EntityCastMember::class, [$uuid, $CastMemberName, $CastMemberType]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        /** @var MockInterface $mockRepository */
        $mockRepository = Mockery::mock(stdClass::class, CastMemberRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')->andReturn($mockEntity);


        /** @var MockInterface $mockInputDTO */
        $mockInputDto = Mockery::mock(CastMemberCreateInputDTO::class, [$CastMemberName, $CastMemberType]);

        /** @var CastMemberRepositoryInterface $mockRepository  */
        $useCase = new CreateCastMemberUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CastMemberCreateOutputDTO::class, $responseUseCase);
        $this->assertNotEmpty($responseUseCase->id);
        $this->assertEquals($CastMemberName, $responseUseCase->name);
        $this->assertEquals($CastMemberType, $responseUseCase->type);


        /** @var MockInterface $spy */
        $spy = Mockery::spy(stdClass::class, CastMemberRepositoryInterface::class);
        $spy->shouldReceive('insert')->andReturn($mockEntity);

        /** @var CastMemberRepositoryInterface $spy  */
        $useCase = new CreateCastMemberUseCase($spy);
        $responseUseCase = $useCase->execute($mockInputDto);

        /** @var MockInterface $spy  */
        $spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
