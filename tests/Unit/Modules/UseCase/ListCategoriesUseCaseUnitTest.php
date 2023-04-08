<?php

namespace Tests\Unit\Modules\UseCase;

use Modules\Category\Dto\ListCategories\ListCategoriesRequestDto;
use Modules\Category\Dto\ListCategories\ListCategoriesResponseDto;
use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\Repositores\PaginationInterface;
use Modules\Category\UseCase\ListCategoriesUseCase;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListCategoriesEmpty()
    {
        $mockPagination = $this->mockPagination();
        $mockRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $mockRequestDto = \Mockery::mock(ListCategoriesRequestDto::class, [
            'filter',
            'order',
        ]);

        $useCase = new ListCategoriesUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $this->assertInstanceOf(ListCategoriesResponseDto::class, $responseUseCase);
        $this->assertCount(0, $responseUseCase->items);

        // Spies
        $spyRepository = \Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spyRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $useCase = new ListCategoriesUseCase($spyRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $mockRepository->shouldHaveReceived('paginate');

        $this->assertInstanceOf(ListCategoriesResponseDto::class, $responseUseCase);
        $this->assertCount(0, $responseUseCase->items);

        \Mockery::close();
    }

    public function testListCategories()
    {
        $register = new \stdClass();
        $register->id = '22';
        $register->name = 'name';
        $register->description = 'description';
        $register->isActive = true;
        $register->createdAt = 'createdAt';
        $register->updatedAt = 'updatedAt';
        $register->deletedAt = 'deletedAt';

        $mockPagination = $this->mockPagination([
            $register,
        ]);

        $mockRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $mockRequestDto = \Mockery::mock(ListCategoriesRequestDto::class, [
            'filter',
            'order',
        ]);

        $useCase = new ListCategoriesUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $this->assertInstanceOf(ListCategoriesResponseDto::class, $responseUseCase);
        $this->assertCount(1, $responseUseCase->items);

        // Spies
        $spyRepository = \Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spyRepository->shouldReceive('paginate')->andReturn($mockPagination);

        $useCase = new ListCategoriesUseCase($spyRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $mockRepository->shouldHaveReceived('paginate');

        $this->assertInstanceOf(ListCategoriesResponseDto::class, $responseUseCase);
        $this->assertInstanceOf(\stdClass::class, $responseUseCase->items[0]);
        $this->assertCount(1, $responseUseCase->items);

        \Mockery::close();
    }

    protected function mockPagination(array $items = [])
    {
        $mockPagination = \Mockery::mock(\stdClass::class, PaginationInterface::class);
        $mockPagination->shouldReceive('items')->andReturn($items);
        $mockPagination->shouldReceive('total')->andReturn(0);
        $mockPagination->shouldReceive('lastPage')->andReturn(0);
        $mockPagination->shouldReceive('fistPage')->andReturn(0);
        $mockPagination->shouldReceive('currentPage')->andReturn(0);
        $mockPagination->shouldReceive('perPage')->andReturn(0);
        $mockPagination->shouldReceive('to')->andReturn(0);
        $mockPagination->shouldReceive('from')->andReturn(0);

        return $mockPagination;
    }
}
