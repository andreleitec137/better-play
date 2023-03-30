<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;


use BetterPlay\Domain\Entity\Category as EntityCategory;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\Category\CreateCategoryUseCase;
use BetterPlay\UseCase\DTO\Category\CreateCategory\{CategoryCreateInputDTO, CategoryCreateOutputDTO};
use Ramsey\Uuid\Uuid as RamseyUuid;
use Mockery;
use stdClass;
use Tests\TestCase;

class CreateCategoryUseCaseTest extends TestCase
{
    public function test_CreateNewCategory()
    {
        $uuid = (string) RamseyUuid::uuid4()->toString();
        $categoryName = 'name cat';
        $categoryDescription = 'description cat';


        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(EntityCategory::class, [$uuid, $categoryName, $categoryDescription]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);



        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);


        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(CategoryCreateInputDTO::class, [$categoryName, $categoryDescription]);

        //Cria uma instancia do UseCase
        $useCase = new CreateCategoryUseCase($this->mockRepository);

        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDTO::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals($categoryDescription, $responseUseCase->description);

        Mockery::close();
    }
}
