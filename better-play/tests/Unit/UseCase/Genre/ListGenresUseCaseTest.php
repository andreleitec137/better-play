<?php

namespace Tests\BetterPlay\Unit\UseCase\Category;

use BetterPlay\Domain\Repository\CategoryRepositoryInterface;
use BetterPlay\Domain\Repository\GenreRepositoryInterface;
use BetterPlay\Domain\Repository\PaginationInterface;
use BetterPlay\UseCase\Genre\ListGenresUseCase;
use BetterPlay\UseCase\DTO\Genre\ListGenre\ListGenresInputDTO;
use BetterPlay\UseCase\DTO\Genre\ListGenre\ListGenresOutputDTO;
use Tests\TestCase;
use Mockery;
use stdClass;

class ListGenresUseCaseTest extends TestCase
{
    public function test_ListGenresEmpty()
    {
        $mockPagination = $this->mockPagination();

        $this->mockRepo = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListGenresInputDTO::class, ['filter', 'desc']);

        $useCase = new ListGenresUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(0, $responseUseCase->items);
        $this->assertInstanceOf(ListGenresOutputDTO::class, $responseUseCase);
    }

    public function test_ListGenres()
    {
        $register = new stdClass();
        $register->id = 'id';
        $register->name = 'name';
        $register->description = 'description';
        $register->is_active = 'is_active';
        $register->created_at = 'created_at';
        $register->updated_at = 'created_at';
        $register->deleted_at = 'created_at';

        $mockPagination = $this->mockPagination([
            $register,
        ]);

        $this->mockRepo = Mockery::mock(stdClass::class, GenreRepositoryInterface::class);
        $this->mockRepo->shouldReceive('paginate')->andReturn($mockPagination);

        $this->mockInputDto = Mockery::mock(ListGenresInputDTO::class, ['filter', 'desc']);

        $useCase = new ListGenresUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertCount(1, $responseUseCase->items);
        $this->assertInstanceOf(stdClass::class, $responseUseCase->items[0]);
        $this->assertInstanceOf(ListGenresOutputDTO::class, $responseUseCase);
    }

    protected function mockPagination(array $items = [])
    {
        $this->mockPagination = Mockery::mock(stdClass::class, PaginationInterface::class);
        $this->mockPagination->shouldReceive('items')->andReturn($items);
        $this->mockPagination->shouldReceive('total')->andReturn(0);
        $this->mockPagination->shouldReceive('currentPage')->andReturn(0);
        $this->mockPagination->shouldReceive('firstPage')->andReturn(0);
        $this->mockPagination->shouldReceive('lastPage')->andReturn(0);
        $this->mockPagination->shouldReceive('perPage')->andReturn(0);
        $this->mockPagination->shouldReceive('to')->andReturn(0);
        $this->mockPagination->shouldReceive('from')->andReturn(0);

        return $this->mockPagination;
    }
}
