<?php

namespace Modules\Category\Repositores\InMemory;

use Core\Domain\Entity\Category;
use Modules\Category\Repositores\CategoryRepositoryInterface;
use Modules\Category\Repositores\SearchCategoryRepositoryInterface;

class InMemoryCategoryRepository implements CategoryRepositoryInterface, SearchCategoryRepositoryInterface
{
    public function insert(Category $category): Category
    {
        return new Category(
            '',
            name: 'Teste Name',
            description: 'Desc test',
            isActive: true
        );
    }

    public function update(Category $category): Category
    {
        return new Category(
            '',
            name: 'Teste Name',
            description: 'Desc test',
            isActive: true
        );
    }

    public function delete(string $id): bool
    {
        return true;
    }

    public function toCategory(string $id): Category
    {
        return new Category(
            '',
            name: 'Teste Name',
            description: 'Desc test',
            isActive: true
        );
    }

    public function findById(Category $category)
    {
    }

    public function findAll(string $filter= '', string $order = 'DESC'): array
    {
        return [];
    }

    public function paginate(string $filter= '', string $order = 'DESC', int $page = 1, int $totalPage = 15): array
    {
        return [];
    }
}
