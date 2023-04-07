<?php

namespace Modules\Category\UseCase;

use Modules\Category\Dto\ListCategory\ListCategoryRequestDto;
use Modules\Category\Dto\ListCategory\ListCategoryResponseDto;
use Modules\Category\Repositores\CategoryRepositoryInterface;

class ListCategoryUseCase
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function execute(ListCategoryRequestDto $request): ListCategoryResponseDto
    {
        $category = $this->categoryRepository->findById($request->id);

        return new ListCategoryResponseDto(
            id: $category->id(),
            name: $category->name,
            description: $category->description,
            isActive: $category->isActive,
            createdAt: $category->createdAt(),
        );
    }
}
