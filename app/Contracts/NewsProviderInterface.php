<?php

namespace App\Contracts;

use App\Models\NewsArticle;

interface NewsProviderInterface
{
    public function fetch(): array;

    public function map(array $response): array;
}
