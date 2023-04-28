<?php

namespace Tests\BetterPlay\Unit\UseCase\Comment;


use BetterPlay\Domain\Entity\Comment as EntityComment;
use BetterPlay\Domain\Enum\CommentType;
use BetterPlay\Domain\Repository\CommentRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\Comment\CreateCommentUseCase;
use BetterPlay\UseCase\DTO\Comment\CreateComment\{CommentCreateInputDTO, CommentCreateOutputDTO};
use Mockery;
use Mockery\MockInterface;
use stdClass;
use Tests\TestCase;

class CreateCommentUseCaseTest extends TestCase
{

    public function test_CreateNewComment()
    {
        $uuid = (string) Uuid::random();
        $CommentDescription = 'Isso é um comentário';


        /** @var MockInterface $mockEntity */
        $mockEntity = Mockery::mock(EntityComment::class, [$uuid, $CommentDescription]);
        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        /** @var MockInterface $mockRepository */
        $mockRepository = Mockery::mock(stdClass::class, CommentRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')->andReturn($mockEntity);


        /** @var MockInterface $mockInputDTO */
        $mockInputDto = Mockery::mock(CommentCreateInputDTO::class, [$CommentDescription]);

        /** @var CommentRepositoryInterface $mockRepository  */
        $useCase = new CreateCommentUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(CommentCreateOutputDTO::class, $responseUseCase);
        $this->assertNotEmpty($responseUseCase->id);
        $this->assertEquals($CommentDescription, $responseUseCase->description);


        /** @var MockInterface $spy */
        $spy = Mockery::spy(stdClass::class, CommentRepositoryInterface::class);
        $spy->shouldReceive('insert')->andReturn($mockEntity);

        /** @var CommentRepositoryInterface $spy  */
        $useCase = new CreateCommentUseCase($spy);
        $responseUseCase = $useCase->execute($mockInputDto);

        /** @var MockInterface $spy  */
        $spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
