<?php

namespace Tests\BetterPlay\Unit\UseCase\Genre;

use BetterPlay\Domain\Entity\Genre as EntityGenre;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\GenreCreateInputDTO;
use BetterPlay\UseCase\DTO\Genre\CreateGenre\GenreCreateOutputDTO;
use BetterPlay\UseCase\Genre\CreateGenreUseCase;
use Mockery;
use stdClass;
use Tests\TestCase;


class CreateGenreUseCaseTest extends TestCase
{

    public function test_CreateNewGenre()
    {
        $uuid = (string) Uuid::random();
        $genreName = 'name genre';
        $genreDescription = 'description genre';


        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(EntityGenre::class, [$uuid, $genreName, $genreDescription]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));



        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);


        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(GenreCreateInputDTO::class, [$genreName, $genreDescription]);

        //Cria uma instancia do UseCase
        $useCase = new CreateGenreUseCase($this->mockRepository);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(GenreCreateOutputDTO::class, $responseUseCase);
        $this->assertNotEmpty($responseUseCase->id);
        $this->assertEquals($genreName, $responseUseCase->name);
        $this->assertEquals($genreDescription, $responseUseCase->description);


        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, GenreRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
        $useCase = new CreateGenreUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
