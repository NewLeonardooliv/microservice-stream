<?php

namespace Modules\Category\Dto\CreateCategory;

class CreateCategoryRequestDto
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) {
    }
}
