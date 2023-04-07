<?php

namespace Modules\Category\Dto\ListCategory;

class ListCategoryResponseDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description = '',
        public bool $isActive = true,
        public string $createdAt = '',
    ) {
    }
}
