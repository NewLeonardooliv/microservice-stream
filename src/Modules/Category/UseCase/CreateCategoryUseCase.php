<?php

namespace Modules\Category\UseCase;

use Modules\Category\Domain\Category;
use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\Dto\{CreateCategoryRequestDto, CreateCategoryResponseDto};

class CreateCategoryUseCase
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->categoryRepository = $repository;
    }

    public function execute(CreateCategoryRequestDto $request): CreateCategoryResponseDto
    {
        $category = new Category(
            name: $request->name,
            description: $request->description,
            isActive: $request->isActive,
        );

        $newCategory = $this->categoryRepository->insert($category);

        return new CreateCategoryResponseDto(
            id: $newCategory->id(),
            name: $newCategory->name,
            description: $category->description,
            isActive: $category->isActive,
            created_at: $category->createdAt(),
        );
    }
}
