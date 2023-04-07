<?php

namespace Tests\Unit\Modules\UseCase;

use Modules\Category\Domain\Category;
use Modules\Category\Dto\CreateCategory\CreateCategoryRequestDto;
use Modules\Category\Dto\CreateCategory\CreateCategoryResponseDto;
use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\UseCase\CreateCategoryUseCase;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'new name';

        $mockEntity = \Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);

        $mockEntity->shouldReceive('id')->once()->andReturn($uuid);

        $mockRepository = \Mockery::mock(\stdClass::class, CategoryRepositoryInterface::class);
        $mockRepository->shouldReceive('insert')->andReturn($mockEntity);

        $mockRequestDto = \Mockery::mock(CreateCategoryRequestDto::class, [
            $categoryName,
        ]);

        $useCase = new CreateCategoryUseCase($mockRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $this->assertInstanceOf(CreateCategoryResponseDto::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals('', $responseUseCase->description);

        \Mockery::close();
    }

    public function testCreateCategoryWithSpyInsert()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'spy name';

        $mockEntity = \Mockery::mock(Category::class, [
            $uuid,
            $categoryName,
        ]);

        $mockEntity->shouldReceive('id')->once()->andReturn($uuid);

        $mockRequestDto = \Mockery::mock(CreateCategoryRequestDto::class, [
            $categoryName,
        ]);

        $spyRepository = \Mockery::spy(\stdClass::class, CategoryRepositoryInterface::class);
        $spyRepository->shouldReceive('insert')->once()->andReturn($mockEntity);

        $useCase = new CreateCategoryUseCase($spyRepository);
        $responseUseCase = $useCase->execute($mockRequestDto);

        $spyRepository->shouldHaveReceived('insert');

        $this->assertInstanceOf(CreateCategoryResponseDto::class, $responseUseCase);
        $this->assertEquals($categoryName, $responseUseCase->name);
        $this->assertEquals('', $responseUseCase->description);

        \Mockery::close();
    }
}
