<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;


use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\DTO\Genre\DeleteGenre\GenreDeleteOutputDTO;
use BetterPlay\UseCase\DTO\Genre\GenreInputDTO;
use BetterPlay\UseCase\Genre\DeleteGenreUseCase;
use Mockery;
use stdClass;
use Tests\TestCase;

class DeleteGenreUseCaseTest extends TestCase
{
    public function test_Delete()
    {
        $uuid = (string) Uuid::random();

        $this->mockRepo = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepo->shouldReceive('delete')->andReturn(true);

        $this->mockInputDto = Mockery::mock(GenreInputDTO::class, [$uuid]);

        $useCase = new DeleteGenreUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(GenreDeleteOutputDTO::class, $responseUseCase);
        $this->assertTrue($responseUseCase->success);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, GenreRepositoryInterface::class);
        $this->spy->shouldReceive('delete')->andReturn(true);
        $useCase = new DeleteGenreUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('delete');
    }

    public function test_DeleteFalse()
    {
        $uuid = (string) Uuid::random();

        $this->mockRepo = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepo->shouldReceive('delete')->andReturn(false);

        $this->mockInputDto = Mockery::mock(GenreInputDTO::class, [$uuid]);

        $useCase = new DeleteGenreUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(GenreDeleteOutputDTO::class, $responseUseCase);
        $this->assertFalse($responseUseCase->success);
    }
}
