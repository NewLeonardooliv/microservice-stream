<?php

namespace Modules\Category\Dto;

class CreateCategoryRequestDto
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $isActive = true,
    ) {
    }
}
