<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\Domain\ValueObject\Uuid;
use BetterPlay\UseCase\Category\DeleteCategoryUseCase;
use BetterPlay\UseCase\DTO\Category\CategoryInputDTO;
use BetterPlay\UseCase\DTO\Category\DeleteCategory\CategoryDeleteOutputDTO;
use Mockery;
use stdClass;
use Tests\TestCase;

class DeleteCategoryUseCaseTest extends TestCase
{
    public function test_Delete()
    {
        $uuid = (string) Uuid::random();

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('delete')->andReturn(true);

        $this->mockInputDto = Mockery::mock(CategoryInputDTO::class, [$uuid]);

        $useCase = new DeleteCategoryUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryDeleteOutputDTO::class, $responseUseCase);
        $this->assertTrue($responseUseCase->success);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $this->spy->shouldReceive('delete')->andReturn(true);
        $useCase = new DeleteCategoryUseCase($this->spy);
        $responseUseCase = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('delete');
    }

    public function test_DeleteFalse()
    {
        $uuid = (string) Uuid::random();

        $this->mockRepo = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $this->mockRepo->shouldReceive('delete')->andReturn(false);

        $this->mockInputDto = Mockery::mock(CategoryInputDTO::class, [$uuid]);

        $useCase = new DeleteCategoryUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(CategoryDeleteOutputDTO::class, $responseUseCase);
        $this->assertFalse($responseUseCase->success);
    }
}
