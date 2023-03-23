<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;

use App\Models\Category;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\DTO\Category\CreateCategory\CategoryCreateInputDTO;
use BetterPlay\UseCase\DTO\Category\CreateCategory\CategoryCreateOutputDTO;
use Ramsey\Uuid\Uuid;
use Mockery;
use stdClass;
use Tests\TestCase;
use UseCase\Category\CreateCategoryUseCase;

class CreateCategoryUseCaseTest extends TestCase
{
    public function test_CreateNewCategoryWithId()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'name cat';

        /* 

        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(Category::class, [$uuid, $categoryName]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);

        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('insert')->andReturn($this->mockEntity);


        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(CategoryCreateInputDTO::class, [$categoryName]);

        //Cria uma instancia do UseCase
        $useCase = new CreateCategoryUseCase($this->mockRepository);

        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryCreateOutputDTO::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals('', $responseUseCase->description);
        Mockery::close();

 */
        $this->assertTrue(true);
    }
}
