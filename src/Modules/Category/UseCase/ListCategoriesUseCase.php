<?php

namespace Modules\Category\UseCase;

use Modules\Category\Dto\ListCategories\ListCategoriesRequestDto;
use Modules\Category\Dto\ListCategories\ListCategoriesResponseDto;
use Modules\Category\Repositores\CategoryRepositoryInterface;

class ListCategoriesUseCase
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function execute(ListCategoriesRequestDto $request): ListCategoriesResponseDto
    {
        $categories = $this->categoryRepository->paginate(
            filter: $request->filter,
            order: $request->order,
            page: $request->page,
            totalPage: $request->totalPage,
        );

        return new ListCategoriesResponseDto(
            items: $categories->items(),
            total: $categories->total(),
            lastPage: $categories->lastPage(),
            fistPage: $categories->fistPage(),
            currentPage: $categories->currentPage(),
            perPage: $categories->perPage(),
            to: $categories->to(),
            from: $categories->from()
        );
    }
}
