<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;

use BetterPlay\Domain\Entity\Category as CategoryEntity;
use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\Category\ListCategoryUseCase;
use BetterPlay\UseCase\DTO\Category\{CategoryInputDTO, CategoryOutputDTO};
use Tests\TestCase;
use Mockery;
use stdClass;

class ListCategoryUseCaseTest extends TestCase
{

    public function test_GetById()
    {
        $id = (string) Uuid::random();

        $this->mockEntity = Mockery::mock(CategoryEntity::class, [
            $id,
            'teste category',
        ]);
        $this->mockEntity->shouldReceive('id')->andReturn($id);
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('findById')
            ->with($id)
            ->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(CategoryInputDTO::class, [
            $id,
        ]);

        $useCase = new ListCategoryUseCase($this->mockRepo);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryOutputDTO::class, $response);
        $this->assertEquals('teste category', $response->name);
        $this->assertEquals($id, $response->id);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('findById')->with($id)->andReturn($this->mockEntity);
        $useCase = new ListCategoryUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
    }
}
