<?php

namespace Modules\Category\Repositores;

use Modules\Category\Domain\Category;

interface CategoryRepositoryInterface
{
    public function insert(Category $category): Category;

    public function update(Category $category): Category;

    public function delete(string $id): bool;

    public function toCategory(string $id): Category;

    public function findById(string $id): Category;

    public function findAll(string $filter = '', string $order = 'DESC'): array;

    public function paginate(string $filter = '', string $order = 'DESC', int $page = 1, int $totalPage = 15): array;
}
