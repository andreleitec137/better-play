<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;

use BetterPlay\Domain\Entity\Category as EntityCategory;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\UseCase\Category\UpdateCategoryUseCase;
use BetterPlay\UseCase\DTO\Category\UpdateCategory\{CategoryUpdateInputDTO, CategoryUpdateOutputDTO};
use Ramsey\Uuid\Uuid as RamseyUuid;
use Mockery;
use stdClass;
use Tests\TestCase;


class UpdateCategoryUseCaseTest extends TestCase
{
    public function test_RenameCategory()
    {
        $uuid = (string) RamseyUuid::uuid4()->toString();
        $categoryName = 'name cat';
        $categoryDescription = 'description cat';


        //Criar um Mock/Duble da entidade
        $this->mockEntity = Mockery::mock(EntityCategory::class, [$uuid, $categoryName, $categoryDescription]);
        $this->mockEntity->shouldReceive('id')->andReturn($uuid);
        $this->mockEntity->shouldReceive('update');
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));


        //Criar um Mock/Duble do repositório
        $this->mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepository->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->mockRepository->shouldReceive('update')->andReturn($this->mockEntity);

        //Criar um Mock/Duble do DTO Input
        $this->mockInputDto = Mockery::mock(CategoryUpdateInputDTO::class, [$uuid, $categoryName, $categoryDescription]);

        //Cria uma instancia do UseCase
        $useCase = new UpdateCategoryUseCase($this->mockRepository);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryUpdateOutputDTO::class, $responseUseCase);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->spy->shouldReceive('update')->andReturn($this->mockEntity);
        $useCase = new UpdateCategoryUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
        $this->spy->shouldHaveReceived('update');

        Mockery::close();
    }
}
