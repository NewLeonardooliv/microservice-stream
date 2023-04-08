<?php

namespace Modules\Category\Dto\ListCategories;

class ListCategoriesResponseDto
{
    public function __construct(
        public array $items,
        public int $total,
        public int $lastPage,
        public int $fistPage,
        public int $currentPage,
        public int $perPage,
        public int $to,
        public int $from
    ) {
    }
}
