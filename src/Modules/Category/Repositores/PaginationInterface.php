<?php

namespace Modules\Category\Repositores;

interface PaginationInterface
{
    public function items(): array;

    public function total(): int;

    public function lastPage(): int;

    public function fistPage(): int;

    public function currentPage(): int;

    public function perPage(): int;

    public function to(): int;

    public function from(): int;
}
