<?php

namespace Tests\BetterPlay\Unit\UseCase\Genre;

use BetterPlay\Domain\Entity\Genre as GenreEntity;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\DTO\Genre\GenreInputDTO;
use BetterPlay\UseCase\DTO\Genre\GenreOutputDTO;
use BetterPlay\UseCase\Genre\ListGenreUseCase;
use Tests\TestCase;
use Mockery;
use stdClass;

class ListGenreUseCaseTest extends TestCase
{

    public function test_GetById()
    {
        $id = (string) Uuid::random();

        $this->mockEntity = Mockery::mock(GenreEntity::class, [
            $id,
            'teste genre',
        ]);
        $this->mockEntity->shouldReceive('id')->andReturn($id);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepo = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepo->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(GenreInputDTO::class, [
            $id,
        ]);

        $useCase = new ListGenreUseCase($this->mockRepo);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(GenreOutputDTO::class, $response);
        $this->assertEquals('teste genre', $response->name);
        $this->assertEquals($id, $response->id);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class,  GenreRepositoryInterface::class);
        $this->spy->shouldReceive('findById')->with($id)->andReturn($this->mockEntity);
        $useCase = new ListGenreUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
    }
}
