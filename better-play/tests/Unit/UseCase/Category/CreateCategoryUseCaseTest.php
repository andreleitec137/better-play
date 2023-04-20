<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;


use BetterPlay\Domain\Entity\Category as EntityCategory;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\Category\CreateCategoryUseCase;
use BetterPlay\UseCase\DTO\Category\CreateCategory\{CategoryCreateInputDTO, CategoryCreateOutputDTO};
use Mockery;
use stdClass;
use Tests\TestCase;

class CreateCategoryUseCaseTest extends TestCase
{
    public function test_CreateNewCategory()
    {
        $uuid = (string) Uuid::random();
        $categoryName = 'name cat';
        $categoryDescription = 'description cat';


        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(EntityCategory::class, [$uuid, $categoryName, $categoryDescription]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));


        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);


        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(CategoryCreateInputDTO::class, [$categoryName, $categoryDescription]);

        //Cria uma instancia do UseCase
        $useCase = new CreateCategoryUseCase($this->mockRepository);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDTO::class, $responseUseCase);
        $this->assertNotEmpty($responseUseCase->id);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals($categoryDescription, $responseUseCase->description);


        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('insert')->andReturn($this->mockEntity);
        $useCase = new CreateCategoryUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('insert');

        Mockery::close();
    }
}
