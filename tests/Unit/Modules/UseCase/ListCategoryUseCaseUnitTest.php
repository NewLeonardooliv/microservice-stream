<?php

namespace Tests\Unit\Modules\UseCase;

use Modules\Category\Domain\Category;
use Modules\Category\Dto\ListCategory\ListCategoryRequestDto;
use Modules\Category\Dto\ListCategory\ListCategoryResponseDto;
use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\UseCase\ListCategoryUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
class ListCategoryUseCaseUnitTest extends TestCase
{
    public function testFindById()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'list name';
        $createdAt = new \DateTime();

        $mockEntity = \Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);

        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn($createdAt->format('Y-m-d H:i:s'));

        $mockRepository = \Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('findById')
            ->with($uuid)
            ->andReturn($mockEntity)
        ;

        $mockRequestDto = \Mockery::mock(ListCategoryRequestDto::class, [
            $uuid,
        ]);

        $useCase = new ListCategoryUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $this->assertInstanceOf(ListCategoryResponseDto::class, $responseUseCase);
        $this->assertEquals($uuid, $responseUseCase->id);

        // Spies
        $mockEntity->shouldReceive('id')->andReturn($uuid);
        $mockEntity->shouldReceive('createdAt')->andReturn($createdAt->format('Y-m-d H:i:s'));

        $spyRepository = \Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spyRepository->shouldReceive('findById')->with($uuid)->andReturn($mockEntity);

        $useCase = new ListCategoryUseCase($spyRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $mockRepository->shouldHaveReceived('findById');

        $this->assertInstanceOf(ListCategoryResponseDto::class, $responseUseCase);
        $this->assertEquals($uuid, $responseUseCase->id);

        \Mockery::close();
    }
}
