<?php

namespace Tests\BetterPlay\Unit\UseCase\Genre;

use BetterPlay\Domain\Entity\Genre as EntityGenre;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\DTO\Genre\UpdateGenre\GenreUpdateInputDTO;
use BetterPlay\UseCase\DTO\Genre\UpdateGenre\GenreUpdateOutputDTO;
use BetterPlay\UseCase\Genre\UpdateGenreUseCase;
use Mockery;
use stdClass;
use Tests\TestCase;


class UpdateGenreUseCaseTest extends TestCase
{
    public function test_update()
    {
        $uuid = (string) Uuid::random();
        $genreName = 'name genre';
        $genreDescription = 'description genre';

        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(EntityGenre::class, [$uuid, $genreName, $genreDescription]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));
        $this->mockEntity->shouldReceive('update');

        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')
            ->times(1)
            ->with($uuid)
            ->andReturn($this->mockEntity);

        $this->mockRepository->shouldReceive('update')
            ->once()
            ->andReturn($this->mockEntity);

        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(GenreUpdateInputDTO::class, [$uuid, 'new name', 'new description']);

        //Cria uma instancia do UseCase
        $useCase = new UpdateGenreUseCase($this->mockRepository);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(GenreUpdateOutputDTO::class, $responseUseCase);
    }
}
