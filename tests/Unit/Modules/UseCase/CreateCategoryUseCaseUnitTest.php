<?php

namespace Tests\Unit\Modules\UseCase;

use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\UseCase\CreateCategoryUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Modules\Category\Domain\Category;
use Mockery;
use Modules\Category\Dto\{CreateCategoryRequestDto, CreateCategoryResponseDto};

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'new name';

        $mockEntity = Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);

        $mockEntity->shouldReceive('id')->once()->andReturn($uuid);

        $mockRepository = Mockery::mock(stdClass::class, CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')->andReturn($mockEntity);

        $mockRequestDto = Mockery::mock(CreateCategoryRequestDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $this->assertInstanceOf(CreateCategoryResponseDto::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals('', $responseUseCase->description);

        // Spy
        $spyRepository = Mockery::spy(stdClass::class, CategoryRepositoryInterface::class);
        $spyRepository->shouldReceive('insert')->andReturn($mockEntity);
        $useCase = new CreateCategoryUseCase($spyRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);
        $spyRepository->shouldHaveReceived('insert');

        // Mockery::close();
    }
}
